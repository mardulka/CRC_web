<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChampionshipController extends Controller{

    /**
     * Returns view of championships list with seasons for sorting on page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show_list(){

        $seasons = DB::table( 'season' )->orderBy( 'order', 'desc' )->get();
        $championships = DB::table( 'championship' )->join( 'series', 'championship.series_id', '=', 'series.series_id' )->get();

        return view( 'sites.championships' )->with( 'seasons', $seasons )->with( 'championships', $championships );
    }


    /**
     * Return main page for specific championship.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show( $id ){
        $championship = DB::table( 'championship' )->where( 'championship_id', '=', $id )->first();
        $sets = DB::table( 'set' )->where( 'championship_id', '=', $id )->get();
        $races = DB::table( 'race' )->join( 'set', 'race.set_id', '=', 'set.set_id' )
                   ->where( 'championship_id', '=', $id )
                   ->orderBy( 'race_no' )->get();
        $ch_results = DB::table( 'race_result' )
                        ->leftJoin( 'valuation', 'valuation.valuation_id', '=', 'race_result.valuation_id' )
                        ->leftJoin( 'race', 'race.race_id', '=', 'race_result.race_id' )
                        ->leftJoin( 'set', 'set.set_id', '=', 'race.set_id' )
                        ->leftJoin( 'championship', 'championship.championship_id', '=', 'set.championship_id' )
                        ->leftJoin( 'participation', 'participation.participation_id', '=', 'race_result.participation_id' )
                        ->leftJoin( 'user', 'user.user_id', '=', 'participation.user_id' )
                        ->leftJoin( 'crew', 'crew.crew_id', '=', 'participation.crew_id' )
                        ->leftJoin( 'team', 'team.team_id', '=', 'participation.team_id' )
                        ->where( 'championship.championship_id', '=', $id )
                        ->selectRaw( 'participation.participation_id as participation_id, user.first_name as first_name, user.last_name as last_name, team.name as team,SUM(valuation.points) as r_points' )
                        ->groupBy( 'participation.participation_id', 'user.first_name', 'user.last_name', 'team.name' )
                        ->orderBy( 'r_points', 'desc' )
                        ->get();

        return view( 'subsites.championship' )->with( 'championship', $championship )->with( 'sets', $sets )->with( 'races', $races )->with( 'ch_results', $ch_results );
    }


}
