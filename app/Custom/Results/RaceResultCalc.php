<?php

namespace App\Custom\Results;

use App\Models\Championship;
use App\Models\Race;
use Illuminate\Support\Collection;

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
    private static Collection $valuation;

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


        //TODO here will be calling PenReorder Class/Object


        //fill or change field "points"
        self::$results->transform( function( $item, $key ){
            self::$valuation->find( $item->position - 1 ) ? $pt = self::$valuation->find( $item->position - 1 ) : $pt = 0;
            $item->points = $pt;
            return $item;
        } );


        //fill or change field class_position and class_points
        foreach(self::$ranks as $rank){
            self::$pos = 1;
            self::$results->transform( callback : function( $item, $key ) use ( $rank ){
                if($item->participation()->first()->application()->first()->rank_id == $rank->rank_id){
                    self::$valuation->find( self::$pos - 1 ) ? $pt = self::$valuation->find( $item->position - 1 ) : $pt = 0;
                    $item->class_position = self::$pos;
                    $item->class_points = $pt;
                    self::$pos += 1;
                }
                return $item;
            } );
        }


        //for those who has penalty flag gets no points, if they are on position allows to get some
        self::$results->transform( function( $item, $key ){
            if($item->penalty_flag()->first()){
                $item->points = 0;
                $item->class_points = 0;
            }
            return $item;
        } );


        // TODO If there are additional points, it will be laced here


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
        if(!self::$valuation = self::$championship->point_table()->first()->valuation()->first())
            return false;

        //load ranks and sort by rank order
        if(!self::$ranks = self::$championship->ranks()->get()->sortBy( 'rank_order' ))
            return false;

        return true;
    }


}
