<?php

namespace App\Custom\Results;

use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Collection;

class RaceResults{

    public int $race_id;
    public     $race_results;

    /**
     * @param $id 'Id of the race.'
     */
    public function __construct( $id ){
        $this->race_id = $id;
    }

    public function __destroy(){

    }

    /**
     * Read race result from database. Race result is identified by race_id from constructor.
     *
     * @return RaceResults
     */
    public function read_results(){
        $this->race_results = DB::table( 'race_result' )->where( 'race_id', '=', $this->race_id )
                                ->join( 'valuation', 'race_result.valuation_id', '=', 'valuation.valuation_id' )
                                ->leftJoin( 'penalty_flag', 'race_result.penalty_flag_id', '=', 'penalty_flag.penalty_flag_id' )
                                ->leftJoin( 'participation', 'race_result.participation_id', '=', 'participation.participation_id' )
                                ->leftJoin( 'user', 'participation.user_id', '=', 'user.user_id' )
                                ->leftJoin( 'crew', 'participation.crew_id', '=', 'crew.crew_id' )
                                ->leftJoin( 'team', 'participation.team_id', '=', 'team.team_id' )
                                ->select( 'participation.participation_id as participation_id','valuation.position as position', 'user.first_name as first_name', 'user.last_name as last_name',
                                          'team.name as team', 'race_result.laps_completed as laps', 'race_result.best_lap as best_lap',
                                          'race_result.consistency as consistency', 'race_result.pitstops_no as pits', 'valuation.points as points',
                                          'penalty_flag.name as flag_name' )
                                ->orderBy( 'position' )->get();
        return $this;
    }

    /**
     * For those who has penalty flag changes points to 0.
     *
     * @return $this
     */
    public function apply_penalty_flag(){
        $this->race_results = $this->race_results->transform( function( $item, $key ){
            if($item->flag_name){
                $item->points = 0;
            }
            return $item;
        } );
        return $this;
    }

}
