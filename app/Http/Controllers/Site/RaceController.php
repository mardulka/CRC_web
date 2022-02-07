<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Race;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RaceController extends Controller{

    /**
     * Return main page for specific race.
     *
     * @param $id
     *
     * @return Application|Factory|View
     */
    public function show( $id ){
        $race = Race::findOrFail( $id );
        $set = $race->set()->first();
        $championship = $set->championship()->first();
        $simulator = $championship->simulator()->first();
        $classes = $set->classes()->orderBy( 'order' )->get();
        $circuit_layout = $race->circuitLayout()->first();
        $circuit = $circuit_layout->circuit()->first();
        $practices = $race->practices()->get();
        $qualifications = $race->qualifications()->get();
        $race_res = DB::table( 'race_result' )
                      ->selectRaw( 'race_result.race_result_id,
                                race_result.init_position,
                                race_result.res_position,
                                race_result.points,
                                race_result.res_class_position,
                                race_result.class_points,
                                race_result.laps_completed,
                                race_result.consistency,
                                race_result.pitstops_no,
                                race_result.best_lap,
                                participation.user_id,
                                participation.driver_first_name,
                                participation.driver_last_name,
                                participation.team_id,
                                participation.team_name,
                                class.class_id,
                                class.name as class_name,
                                penalty_flag.name as penalty_name,
                                sum(penalization.position_penalty) as penalty' )
                      ->leftjoin( 'participation', 'participation.participation_id', '=', 'race_result.participation_id' )
                      ->leftjoin( 'application', 'application.participation_id', '=', 'participation.participation_id' )
                      ->leftjoin( 'class', 'class.class_id', '=', 'application.class_id' )
                      ->leftjoin( 'penalty_flag', 'race_result.penalty_flag_id', '=', 'penalty_flag.penalty_flag_id' )
                      ->leftJoin( 'race_result_penalization', 'race_result.race_result_id', '=', 'race_result_penalization.race_result_id' )
                      ->leftJoin( 'penalization', 'race_result_penalization.penalization_id', '=', 'penalization.penalization_id' )
                      ->where( 'race_result.race_id', $race->race_id )
                      ->where( 'class.set_id', $set->set_id )
                      ->groupBy( 'race_result.race_result_id',
                                 'race_result.init_position',
                                 'race_result.res_position',
                                 'race_result.points',
                                 'race_result.res_class_position',
                                 'race_result.class_points',
                                 'race_result.laps_completed',
                                 'race_result.consistency',
                                 'race_result.pitstops_no',
                                 'race_result.best_lap',
                                 'participation.user_id',
                                 'participation.driver_first_name',
                                 'participation.driver_last_name',
                                 'participation.team_id',
                                 'participation.team_name',
                                 'class.class_id',
                                 'class.name',
                                 'penalty_flag.name' )
                      ->orderBy( 'race_result.res_position', 'asc' )
                      ->get();



        return view( 'subsites.race' )
            ->with( 'race', $race )
            ->with( 'race_res', $race_res )
            ->with( 'set', $set )
            ->with( 'championship', $championship )
            ->with( 'simulator', $simulator )
            ->with( 'circuit_layout', $circuit_layout )
            ->with( 'circuit', $circuit )
            ->with( 'practices', $practices )
            ->with( 'qualifications', $qualifications )
            ->with( 'classes', $classes );

    }
}
