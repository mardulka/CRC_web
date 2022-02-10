<?php

namespace App\Custom\Results;

use App\Exceptions\ResultsLockedException;
use App\Models\Championship;
use App\Models\Race;
use App\Models\Set;
use Illuminate\Support\Collection;

/**
 * Calculates results for given race_id
 *
 */
class RaceResult{

    //--properties------------------------------------------------------------------------------------------------------------------------------------
    /**
     * Race_id from DB
     *
     * @var int
     */
    private static int $id;

    /**
     * Race from DB
     *
     * @var Race
     */
    private static Race $race;

    /**
     * Collection of race results from DB
     *
     * @var Collection
     */
    private static Collection $results;

    /**
     * Set from DB
     *
     * @var Set
     */
    private static Set $set;

    /**
     * Championship from DB
     *
     * @var Championship
     */
    private static Championship $championship;

    /**
     * Collection of valuation from DB
     *
     * @var Collection
     */
    private static Collection $valuations;

    /**
     * Collection of classes in championship from DB
     *
     * @var Collection
     */
    private static Collection $classes;


    //--methods---------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Mark race that results of it need to be recalculated. Provide it in set and championship too.
     *
     * @param $id
     *
     * @return bool true if changed ok, false otherwise
     */
    public static function needRecalculate( $id ) : bool{
        self::$race = Race::findOrFail( $id );
        self::$race->res_updated = false;
        self::$race->save();

        //call same for championship
        SetResult::needRecalculate( self::$race->set_id );

        return true;
    }


    /**
     * Public function for recalculating results
     *
     * @param $id
     *
     * @return bool
     * @throws ResultsLockedException
     */
    public static function calculate( $id ) : bool{
        self::$id = $id;

        //load data from DB
        if(!self::DbLoad()){
            return false;
        }

        //check if race is locked for recalculating
        if(self::$race->res_locked == true){
            throw new ResultsLockedException( 'Závod je uzamčen pro přepočítání výsledků!' );
        }


        //calling PenReorder Class/Object to apply penalties, fill res_position attribute and sort it
        self::$results = self::RacePenalties( self::$results );


        //fill or change field "points"
        self::$results->transform( function( $item, $key ){
            $item->points = self::$valuations->where( 'position', '=', $item->res_position )->first()->points ?? 0;
            return $item;
        } );


        //saving
        if(!self::DbSave()){
            return false;
        }


        //fill or change field class_position and class_points
        //self::$results->fresh();
        foreach(self::$classes as $class){

            if($class->overall)
                continue;

            //filter $results by participations
            $class_results = self::$results->whereIn( 'participation_id', $class->participation()->get()->modelKeys() );
            $class_results = $class_results->values();


            //apply positions and points --> should be already sorted
            $class_results->transform( function( $item, $key ){
                $item->res_class_position = $key + 1;
                $item->class_points = self::$valuations->find( $key + 1 )->points ?? 0;
                return $item;
            } );

            //save results
            foreach($class_results as $class_result){
                $class_result->save();
            }

        }

        //for those who has penalty flag gets no points, if they are on position allows to get some
        self::$results->fresh();
        self::$results->transform( function( $item, $key ){
            if($item->penalty_flag){
                $item->points = 0;
                $item->class_points = 0;
            }
            return $item;
        } );


        // If there are additional points, it will be laced here (best lap, won Q) - based on championship attribute if applicable
        if(self::$championship->points_best_lap > 0){
            self::$results->sortBy( 'best_lap' )->where( 'best_lap', '>', '00:00:00.000' )->first()->points += self::$championship->points_best_lap;
        }
        if(self::$championship->points_q_won > 0){
            $qw = self::$race->qualifications()->orderByDesc( 'qualification_no' )->first()->qualifyResults()->orderBy( 'res_position' )->first()->participation()->first()->participation_id;
            self::$results->where( 'participation_id', '=', $qw )->first()->points += self::$championship->points_q_won;
        }


        //saving
        if(!self::DbSave()){
            return false;
        }


        // update updated status of race results in race
        self::$race->res_updated = true;
        self::$race->save();

        return true;
    }

    /**
     * Write final position after applied penalization and order them by.
     *
     * @param $results Collection of results to reorder
     *
     * @return Collection modified collection of results
     */
    private static function RacePenalties( $results ) : Collection{

        //reset keys to make it usable
        $results = $results->values();

        //load position penalties and sum them into new result attribute
        $results->transform( function( $item, $key ){
            //they are sorted, key restarted --> position is key + 1 + sum of position penalties
            $item->res_position = $key + 1 + $item->penalization->sum( 'position_penalty' );
            return $item;
        } );


        //sort by position and then init position (before penalties), both ascending
        $results = $results->sortBy( [ [ 'res_position', 'asc' ], [ 'init_position', 'desc' ] ] );


        //Put PEN FLAGS to end
        [ $pen_flags, $not_penalized ] = $results->partition( function( $item, $key ){
            return $item->penalty_flag;
        } );
        $results = $not_penalized->concat( $pen_flags );


        //again reset keys and apply them as positions
        $results = $results->values();
        $results->transform( function( $item, $key ){
            //they are sorted, key restarted --> position is key + 1
            $item->res_position = $key + 1;
            return $item;
        } );

        return $results;
    }


    /**
     * Loading Data from database
     *
     * @return bool
     */
    private static function DbLoad() : bool{

        //load race
        if(!self::$race = Race::find( self::$id ))
            return false;

        //load results and sort by initial position
        if(!self::$results = self::$race->raceResults()->get()->sortBy( 'init_position' )->load( 'penalization', 'penalty_flag' ))
            return false;

        //load set
        if(!self::$set = self::$race->set()->first())
            return false;

        //load championship
        if(!self::$championship = self::$set->championship()->first())
            return false;

        //load valuation
        if(!self::$valuations = self::$championship->point_table()->first()->valuations()->get())
            return false;

        //load ranks and sort by rank order
        if(!self::$classes = self::$set->classes()->get()->sortBy( 'order' ))
            return false;


        return true;
    }


    /**
     * Saving Data back to database
     *
     * @return bool
     */
    private static function DbSave() : bool{

        foreach(self::$results as $result){
            $result->save();
        }

        return true;
    }


}
