<?php

namespace App\Custom\Results;

use App\Models\Championship;
use App\Models\Race;
use Illuminate\Support\Collection;
use mysql_xdevapi\Exception;

/**
 * Calculates results for given race_id
 *
 */
class RaceResultCalc{

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
     * Collection of rank in championship from DB
     *
     * @var Collection
     */
    private static Collection $ranks;

    /**
     * Help value
     *
     * @var int
     */
    private static int $pos;

    //--methods---------------------------------------------------------------------------------------------------------------------------------------

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


        //TODO here will be calling PenReorder Class/Object to fill res_position attribute
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


        //fill or change field class_position and class_points
        foreach(self::$ranks as $rank){
            self::$pos = 1;
            self::$results->transform( function( $item, $key ) use ( $rank ){

                $set = $item->race()->first()->set()->first();
                $r_rank = $item->participation()->first()->applications()->where('set_id', '=', $set->set_id)->first();

                if($r_rank->rank_id === $rank->rank_id){
                    $pt = self::$valuations->find( self::$pos )->points ?? 0;
                    $item->class_order = $rank->pivot->rank_order;
                    $item->res_class_position = self::$pos;
                    $item->class_points = $pt;
                    self::$pos += 1;
                }
                return $item;
            });
        }



        //for those who has penalty flag gets no points, if they are on position allows to get some
        self::$results->transform( function( $item, $key ){
            if($item->penalty_flag()->first()){
                $item->points = 0;
                $item->class_points = 0;
            }
            return $item;
        } );


        // If there are additional points, it will be laced here (best lap, won Q) - based on championship attribute if applicable
        if(self::$championship->points_best_lap > 0){
            self::$results->sortBy('best_lap')->first()->points += self::$championship->points_best_lap;
        }
        if(self::$championship->points_q_won > 0){
            $qw = self::$race->qualifications()->orderByDesc('qualification_no')->first()->qualifyResults()->orderBy('res_position')->first()->participation()->first()->participation_id;
            self::$results->where('participation_id', '=', $qw)->points += self::$championship->points_q_won;
        }



        //saving
        if(!self::DbSave()){
            return false;
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

        //load championship
        if(!self::$championship = self::$race->set()->first()->championship()->first())
            return false;

        //load valuation
        if(!self::$valuations = self::$championship->point_table()->first()->valuations()->get())
            return false;

        //load ranks and sort by rank order
        if(!self::$ranks = self::$championship->ranks()->get()->sortBy( 'rank_order' ))
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
