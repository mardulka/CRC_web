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
        $r_results = DB::table('race_result')->where('race_id', '=', $id)->get();
        $set = DB::table('set')->where('set.set_id', '=', $race->set_id)->first();
        $championship = DB::table('championship')->where('championship_id', '=', $set->championship_id)->first();

        return view( 'subsites.race' )->with( 'race', $race )->with( 'qualifications', $qualifications )->with( 'practices', $practices )
            ->with('r_results', $r_results)->with('set', $set)->with('championship', $championship);
    }
}
