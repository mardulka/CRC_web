<?php

namespace App\Custom\Results;

use App\Exceptions\ResultsLockedException;
use App\Models\Set;

class SetResult{

    /**
     * Set_id from DB
     *
     * @var int
     */
    private static int $id;

    /**
     * Set from DB
     *
     * @var Set
     */
    private static Set $set;


    //--methods---------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Mark set that results of it need to be recalculated. Provide it in championship too.
     *
     * @param $id
     *
     * @return bool true if changed ok, false otherwise
     */
    public static function needRecalculate( $id ) : bool{
        //load from DB
        if(!self::$set = Set::find( $id ))
            return false;

        //change attribute
        self::$set->res_updated = false;

        //save into DB
        self::$set->save();

        //call same for championship
        ChampionshipResult::needRecalculate( self::$set->championship_id );

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
        if(self::$set->res_locked == true){
            throw new ResultsLockedException( 'Set je uzamčen pro přepočítání výsledků!' );
        }


        //load applications and sum points from race_results
        $applications = self::$set->applications()->get();
        $applications->transform( function( $item, $key ){
            $item->res_points = $item->raceResults()->sum( 'points' );
            $item->res_class_points = $item->raceResults()->sum( 'class_points' );
            return $item;
        } );


        //write overall positions and save these partial results
        $applications->sortBy( 'res_points' )->values();
        $applications->transform( function( $item, $key ){
            $item->res_position = $key + 1;
            $item->save();
        } );


        //order for each class and save
        $classes = self::$set->classes()->get();
        $classes->map( function( $class, $key ){
            $appl = $class->applications()->orderBy( 'res_class_points' )->get();
            $appl->values();
            $appl->transform( function( $item, $key ){
                $item->res_class_position = $key + 1;
                $item->save();
            } );
        } );

        // mark that this set has results updated
        self::$set->res_updated = true;
        self::$set->save();

        return true;
    }


    /**
     * Loading Data from database
     *
     * @return bool
     */
    private static function DbLoad() : bool{

        //load set
        if(!self::$set = Set::find( self::$id ))
            return false;

        return true;
    }

}
