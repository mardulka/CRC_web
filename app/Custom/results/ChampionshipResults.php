<?php

namespace App\Custom\Results;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ChampionshipResults{

    public $championship_id;
    public $champ_results;
    public $results_arr = [];

    /**
     * @param $id 'Id of the championship'
     */
    public function __construct( $id ){
        $this->championship_id = $id;
    }


    public function load_results(){
        $races = DB::table( 'race' )
                   ->leftJoin( 'set', 'set.set_id', '=', 'race.set_id' )
                   ->leftJoin( 'championship', 'championship.championship_id', '=', 'set.championship_id' )
                   ->where( 'championship.championship_id', '=', $this->championship_id )
                   ->select( 'race.race_id as race_id' )
                   ->get();

        $i = 0;
        foreach($races as $race){
            $r_results = new RaceResults( $race->race_id );
            $r_results->read_results()->apply_penalty_flag();
            $r_results = $r_results->race_results->toArray();
            $this->results_arr[ $i ] = $r_results;
            ++$i;
        }
        $this->results_arr = collect( $this->results_arr )->flatten( 1 )->toArray();

        return $this;
    }


    public function combine(){
        $new_arr = [];
        foreach($this->results_arr as $arr){
            $id = $arr->participation_id;
            if(isset( $new_arr[ $id ] )){
                $new_arr[ $id ]->points += $arr->points;
            }else{
                $new_arr[ $id ] = $arr;
            }
        }
        $this->champ_results = collect( $new_arr )->sortByDesc( 'points' );

        return $this;
    }

}
