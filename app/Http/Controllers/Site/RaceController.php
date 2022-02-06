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
        $classes = $set->classes()->orderBy('order')->get();
        $race_res = DB::table( 'race_result' )
                      ->leftjoin( 'participation', 'participation.participation_id', '=', 'race_result.participation_id' )
                      ->leftjoin( 'application', 'application.participation_id', '=', 'participation.participation_id' )
                      ->leftjoin( 'class', 'class.class_id', '=', 'application.class_id' )
                      ->where( 'race_result.race_id', $race->race_id )
                      ->where( 'class.set_id', $set->set_id )
                      ->orderBy( 'race_result.res_position', 'asc' )
                      ->get();


        //TODO: Výsledky se načítají dost pomalu. Upravit data tak aby se vše načetlo v kontroleru jednou Query a pak už jenom vypsalo. (Eager loading)


        return view( 'subsites.race' )
            ->with( 'race', $race )
            ->with( 'race_res', $race_res )
            ->with( 'championship', $championship )
            ->with( 'simulator', $simulator )
            ->with( 'classes', $classes );
    }
}
