<?php

namespace App\Custom\Results;

use Illuminate\Support\Collection;

class PenReorder{

    //reorder according to penalties
    public static function RacePenalties( $results ) : Collection{

        //load position penalties and sum them into new result attribute
        $results->transform( function( $item, $key ){
            $item->rem_pos_penalty = $item->penalization()->get()->sum( 'position_penalty' );
            return $item;
        } );


        //swap items according to number of penalty position
        for($j = 0; $j < count( $results ); ++$j){
            if($results[ $j ]->rem_pos_penalty == 0)
                continue;
            while($results[ $j ]->pos_penalty > 0 || !$results[ $j + 1 ]){
                $results = self::swap( $results, $j, $j + 1 );
                $results[ $j + 1 ]->rem_pos_penalty -= 1;
            }
        }

        return $results;
    }

    /**
     * Swapping two elements in given array identified by two given keys
     *
     * @param $arr     array Array where two elements should be swapped.
     * @param $key_one int Key of first element.
     * @param $key_two int Key of second element.
     *
     * @return array Modified array
     */
    private static function swap( Collection $arr, int $key_one, int $key_two ){
        $temp = $arr[ $key_two ];
        $arr[ $key_two ] = $arr[ $key_one ];
        $arr[ $key_one ] = $temp;
        return $arr;
    }

}
