<?php

namespace App\Custom\Results;

use App\Models\Championship;
use App\Models\Race;
use App\Models\Set;
use Illuminate\Support\Collection;
use mysql_xdevapi\Exception;

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

    /**
     * Help value
     *
     * @var int
     */
    private static int $pos;

    //--methods---------------------------------------------------------------------------------------------------------------------------------------

    //TODO: Revise methods for calculating results. Add switch for marking results as updated.

    /**
     * Mark race that results of it need to be recalculated. Provide it in set and championship too.
     *
     * @param $id
     *
     * @return bool true if changed ok, false otherwise
     */
    public static function needRecalculate($id) : bool{
        //load race from DB
        if(!self::$race = Race::find( self::$id ))
            return false;

        //change attribute
        self::$race->res_updated = false;

        //save into DB
        self::$race->save();

        //call same for championship
        ChampionshipResult::needRecalculate(self::$race->set_id);

        return true;
    }



    /**
     * Only public function for calling outside and start process
     *
     * @param $id
     *
     * @return bool
     */
    public static function calculate( $id ) : bool{
        self::$id = $id;


        //load data from DB
        if(!self::DbLoad()){
            return false;
        }

        //calling PenReorder Class/Object to fill res_position attribute
        self::$results = PenReorder::RacePenalties(self::$results);


        // place res_positions according to results order
        $iteration = 1;
        foreach(self::$results as $result){
            $result->res_position = $iteration;
            ++$iteration;
        }
        self::$results->sortBy('res_position');


        //fill or change field "points"
        self::$results->transform( function( $item, $key ){
            $pt = self::$valuations->find( $item->res_position )->points ?? 0;
            $item->points = $pt;
            return $item;
        } );

        //saving
        if(!self::DbSave()){
            return false;
        }

    //TODO: test if it is OK

        //fill or change field class_position and class_points
        foreach(self::$classes as $class){
            self::$pos = 1;
            $participations = $class->participation()->get()->attributestoarray('participation_id');
            $class_results = self::$race->raceResults()->get()->intersect(RaceResult::all()->whereIn('race_result_id', $participations))->sortBy('res_position')->get();

            //change class position and class points
            $class_results->transform( function( $item, $key ){
                $item->res_class_position = self::$pos;
                $item->class_points = self::$valuations->find( self::$pos )->points ?? 0;
                self::$pos += 1;

                return $item;
            });

            //save results
            $class_results->save();
        }

    //TODO: What about if first gets DQ?

        //for those who has penalty flag gets no points, if they are on position allows to get some
        self::$results->refresh();
        self::$results->transform( function( $item, $key ){
            if($item->penalty_flag()->first()){
                $item->points = 0;
                $item->class_points = 0;
            }
            return $item;
        } );


        // If there are additional points, it will be laced here (best lap, won Q) - based on championship attribute if applicable
        if(self::$championship->points_best_lap > 0){
            self::$results->sortBy('best_lap')->where('best_lap', '>', '00:00:00.000')->first()->points += self::$championship->points_best_lap;
        }
        if(self::$championship->points_q_won > 0){
            $qw = self::$race->qualifications()->orderByDesc('qualification_no')->first()->qualifyResults()->orderBy('res_position')->first()->participation()->first()->participation_id;
            self::$results->where('participation_id', '=', $qw)->first()->points += self::$championship->points_q_won;
        }




        return true;
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
        if(!self::$results = self::$race->raceResults()->get()->sortBy( 'init_position' ))
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
