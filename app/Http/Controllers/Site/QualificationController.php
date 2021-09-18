<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
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
        $qualification = DB::table( 'qualification' )->where( 'qualification_id', '=', $id )->first();
        $q_results = DB::table( 'qualify_result' )->where( 'qualification_id', '=', $id )->get();
        $race = DB::table( 'race' )->where( 'race.race_id', '=', $qualification->race_id )->first();
        $set = DB::table( 'set' )->where( 'set.set_id', '=', $race->set_id )->first();
        $championship = DB::table( 'championship' )->where( 'championship_id', '=', $set->championship_id )->first();

        return view( 'subsites.qualification' )->with( 'qualification', $qualification )->with( 'q_results', $q_results )->with( 'race', $race )
                                               ->with( 'set', $set )->with( 'championship', $championship );
    }
}
