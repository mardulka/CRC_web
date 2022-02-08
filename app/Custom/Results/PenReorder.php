<?php

namespace App\Custom\Results;

use Illuminate\Support\Collection;

class PenReorder{

    //reorder according to penalties
    public static function RacePenalties( $results ) : Collection{

        //reset keys to make it usable
        $results = $results->values();

        //load position penalties and sum them into new result attribute
        $results->transform( function( $item, $key ){
            //they are sorted, key restarted --> position is key + 1 + sum of position penalties
            $item->res_position = $key + 1 + $item->penalization->sum( 'position_penalty' );
            return $item;
        } );


        //sort by position and then init position (before penalties), both ascending
        $results = $results->sortBy([
            [ 'res_position', 'asc' ],
            [ 'init_position', 'desc' ],
        ]);


        //DQ to end
        [ $pen, $unpenalizied ] = $results->partition( function( $item, $key ){
            return $item->penalty_flag;
        } );
        $results = $unpenalizied->concat( $pen );


        //again reset keys and apply them as positions
        $results = $results->values();
        $results->transform( function( $item, $key ){
            //they are sorted, key restarted --> position is key + 1
            $item->res_position = $key + 1;
            return $item;
        } );


        return $results;
    }
}
