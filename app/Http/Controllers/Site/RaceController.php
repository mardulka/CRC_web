<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
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
        $race = DB::table( 'race' )->where( 'race_id', '=', $id )->first();
        $qualifications = DB::table( 'qualification' )->where( 'race_id', '=', $id )->get();
        $practices = DB::table( 'practice' )->where( 'race_id', '=', $id )->get();
        $r_results = DB::table( 'race_result' )->where( 'race_id', '=', $id )
                       ->join( 'valuation', 'race_result.valuation_id', '=', 'valuation.valuation_id' )
                       ->leftJoin( 'penalty_flag', 'race_result.penalty_flag_id', '=', 'penalty_flag.penalty_flag_id' )
                       ->leftJoin( 'participation', 'race_result.participation_id', '=', 'participation.participation_id' )
                       ->leftJoin( 'user', 'participation.user_id', '=', 'user.user_id' )
                       ->leftJoin( 'crew', 'participation.crew_id', '=', 'crew.crew_id' )
                       ->leftJoin( 'team', 'participation.team_id', '=', 'team.team_id' )
                       ->select( 'valuation.position as position', 'user.first_name as first_name', 'user.last_name as last_name',
                                 'team.name as team', 'race_result.laps_completed as laps', 'race_result.best_lap as best_lap',
                                 'race_result.consistency as consistency', 'race_result.pitstops_no as pits', 'valuation.points as points',
                                 'penalty_flag.name as flag_name' )
                       ->orderBy( 'position' )->get();
        $set = DB::table( 'set' )->where( 'set.set_id', '=', $race->set_id )->first();
        $championship = DB::table( 'championship' )->where( 'championship_id', '=', $set->championship_id )->first();
        $simulator = DB::table('simulator')->where('simulator_id', '=', $championship->simulator_id)->first();
        $car_categories = DB::table( 'car_category' )
                          ->leftJoin( 'car_category_set', 'car_category.car_category_id', '=', 'car_category_set.car_category_id' )
                          ->leftJoin( 'set', 'set.set_id', '=', 'car_category_set.set_id' )
                          ->where( 'set.set_id', '=', $set->set_id )->get();

        return view( 'subsites.race' )
            ->with( 'race', $race )
            ->with( 'qualifications', $qualifications )
            ->with( 'practices', $practices )
            ->with( 'r_results', $r_results )
            ->with( 'set', $set )
            ->with( 'championship', $championship )
            ->with( 'simulator', $simulator )
            ->with('car_categories', $car_categories);
    }
}
