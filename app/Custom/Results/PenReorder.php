<?php

namespace App\Custom\Results;

use Illuminate\Support\Collection;

class PenReorder{

    //reorder according to penalties
    public static function RacePenalties( $results ) : Collection{

        //load position penalties and sum them into new result attribute
        $results->transform( function( $item, $key ){
            $item->res_position = 0;
            $item->rem_pos_penalty = $item->penalization()->get()->sum( 'position_penalty' );
            return $item;
        } );

        //reset keys to make it usable
        $results = $results->values();

        //swap items according to number of penalty position
        for($j = 1; $j < count( $results ); ++$j){
            if($results[ $j ]->rem_pos_penalty == 0)
                continue;
            $results = self::move( $results, $j, $results[ $j ]->rem_pos_penalty );
        }

        return $results;
    }

    /**
     * Swapping two elements in given array identified by two given keys
     *
     * @param $arr     Collection Array where two elements should be swapped.
     * @param $key_one int Key of first element.
     * @param $key_two int Key of second element.
     *
     * @return Collection Modified array
     */
    private static function swap( Collection $arr, int $key_one, int $key_two ){
        $temp = $arr[ $key_two ];
        $arr[ $key_two ] = $arr[ $key_one ];
        $arr[ $key_one ] = $temp;
        return $arr;
    }

    /**
     * @param Collection $arr    Array where the element should be moved
     * @param int        $key    Key of the element
     * @param int        $number Number of positions to be moved
     *
     * @return Collection Modified array
     */
    private static function move( Collection $arr, int $key, int $number ){
        for($k = 0; $k < $number; ++$k, ++$key){
            if(!isset( $arr[ $key + 1 ] )){
                break;
            }
            $arr[ $key ]->rem_pos_penalty -= 1;
            $arr = self::swap( $arr, $key, $key + 1 );
        }
        return $arr;
    }

}
