<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Qualification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QualificationController extends Controller{

    /**
     * Return main page for specific qualification.
     *
     * @param $id
     *
     * @return Application|Factory|View
     */
    public function show( $id ){
        $qualification = Qualification::findOrFail($id);
        $q_results = DB::table( 'qualify_result' )->where( 'qualification_id', '=', $id )
                       ->leftJoin( 'penalty_flag', 'qualify_result.penalty_flag_id', '=', 'penalty_flag.penalty_flag_id' )
                       ->leftJoin( 'participation', 'qualify_result.participation_id', '=', 'participation.participation_id' )
                       ->leftJoin( 'user', 'participation.user_id', '=', 'user.user_id' )
                       ->leftJoin( 'crew', 'participation.crew_id', '=', 'crew.crew_id' )
                       ->leftJoin( 'team', 'participation.team_id', '=', 'team.team_id' )
                       ->select( 'user.first_name as first_name', 'user.last_name as last_name', 'team.name as team',
                                 'qualify_result.laps_completed as laps', 'qualify_result.best_lap as best_lap',
                                 'qualify_result.man_position as man_position', 'penalty_flag.name as flag_name' )
                       ->orderBy( 'best_lap' )
                       ->orderBy( 'man_position' )
                       ->get();
        $race = $qualification->race()->first();
        $set = $race->set()->first();
        $championship = $set->championship()->first();

        return view( 'subsites.qualification' )
            ->with( 'qualification', $qualification )
            ->with( 'q_results', $q_results )
            ->with( 'race', $race )
            ->with( 'set', $set )
            ->with( 'championship', $championship );
    }
}
