<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChampionshipController extends Controller{

    /**
     * Return list of seasons and its championships with data
     */



    public function show(){

        $seasons = DB::table('season')->orderBy('order', 'desc')->get();
        $championships = DB::table('championship')->join('series', 'championship.series_id', '=', 'series.series_id')->get();

        return view('sites.championships')->with('seasons', $seasons)->with('championships', $championships);
    }


}
