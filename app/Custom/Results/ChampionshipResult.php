<?php

namespace App\Custom\Results;

use App\Exceptions\ResultsLockedException;
use App\Models\Championship;


class ChampionshipResult{


    /**
     * Championship_id from DB
     *
     * @var int
     */
    private static int $id;


    /**
     * Championship from DB
     *
     * @var Championship
     */
    private static Championship $championship;


    //--methods---------------------------------------------------------------------------------------------------------------------------------------

    //TODO: Add methods for calculating results

    /**
     * Mark championship that results of it need to be recalculated
     *
     * @param $id
     *
     * @return bool true if changed ok, false otherwise
     */
    public static function needRecalculate( $id ) : bool{
        //load from DB
        if(!self::$championship = Championship::find( $id ))
            return false;

        //change attribute
        self::$championship->res_updated = false;

        //save into DB
        self::$championship->save();

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

        //check if championship is locked for recalculating
        if(self::$championship->res_locked == true){
            throw new ResultsLockedException( 'Šampionát je uzamčen pro přepočítání výsledků!' );
        }

        // load all participation for championship and fill with overall points
        $participation = self::$championship->participation()->get();
        $overall_classes = self::$championship->classes()->where( 'class.overall', 1 )->get()->modelKeys();
        $participation->map( function( $partip, $key ) use ( $overall_classes ){
            $partip->res_points = $partip->applications()->whereIn( 'class_id', $overall_classes )->sum( 'res_points' );
        } );

        //order and fill overall positions, save then
        $participation->sortBy( 'res_points' )->values();
        $participation->map( function( $partip, $key ){
            $partip->res_position = $key + 1;
            $partip->save();
        } );

        //TODO doplnit výpočet o body za účast


        // load all team participation for championship and fill with overall points
        $team_partip = self::$championship->teamParticipation()->get();
        $team_partip->map(function($tp, $key){
            $tp->res_points = $tp->participation()->sum('res_points');
        });

        //order and fill positions, save then
        $team_partip->sortBy( 'res_points' )->values();
        $team_partip->map( function( $tp, $key ){
            $tp->res_position = $key + 1;
            $tp->save();
        } );



        // mark that this set has results updated
        self::$championship->res_updated = true;
        self::$championship->save();

        return true;
    }


    /**
     * Loading Data from database
     *
     * @return bool
     */
    private static function DbLoad() : bool{

        //load set
        if(!self::$championship = Championship::find( self::$id ))
            return false;

        return true;
    }


}
