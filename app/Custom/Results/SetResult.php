<?php

namespace App\Custom\Results;

use App\Models\Set;

class SetResult{

    /**
     * Set from DB
     *
     * @var Set
     */
    private static Set $set;



    //--methods---------------------------------------------------------------------------------------------------------------------------------------

    //TODO: Add methods for calculating results


    /**
     * Mark set that results of it need to be recalculated. Provide it in championship too.
     *
     * @param $id
     *
     * @return bool true if changed ok, false otherwise
     */
    public static function needRecalculate($id) : bool{
        //load from DB
        if(!self::$set = Set::find( $id ))
            return false;

        //change attribute
        self::$set->res_updated = false;

        //save into DB
        self::$set->save();

        //call same for championship
        ChampionshipResult::needRecalculate(self::$set->championship_id);

        return true;
    }


}
