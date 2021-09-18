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

        return view( 'subsites.championship' )->with( 'championship', $championship )->with( 'sets', $sets )->with( 'races', $races );
    }


}
