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

        // TODO - test output  - delete
        echo "position | penal. \n";
        foreach($results as $result){
            echo $result->init_position . " | " . $result->rem_pos_penalty . "\n";
        }

        //swap items according to number of penalty position
        ////TODO if they are 2 with penalties on neighbour position, they rotate until one of them remains 0 penalty to application (tested on race_id 1)
        for($j = 1; $j < count( $results ); ++$j){
            if($results[ $j ]->rem_pos_penalty == 0)
                continue;
            while($results[ $j ]->rem_pos_penalty > 0 && $j + 1 < count( $results )){
                $results[ $j ]->rem_pos_penalty -= 1;
                // TODO - test output  - delete
                echo "swap ".($j+1)." with ".($j+2)."\n";
                $results = self::swap( $results, $j, $j + 1 );
            }
        }
        // TODO - test output - delete
        echo "position | penal. \n";
        foreach($results as $result){
            echo $result->init_position . " | " . $result->rem_pos_penalty . "\n";
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

}
