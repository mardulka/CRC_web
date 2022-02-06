<?php

namespace App\Custom\Results;

use App\Models\Championship;


class ChampionshipResult{

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
    public static function needRecalculate($id) : bool{
        //load from DB
        if(!self::$championship = Championship::find( $id ))
            return false;

        //change attribute
        self::$championship->res_updated = false;

        //save into DB
        self::$championship->save();

        return true;
    }


}
