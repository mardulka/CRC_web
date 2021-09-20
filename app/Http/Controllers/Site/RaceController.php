<?php

namespace App\Http\Controllers\Site;

use App\custom\results\race_results;
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

        //load and calculate results
        $r_results = new race_results($id);
        $r_results->read_results()->apply_penalty_flag();

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
            ->with( 'r_results', $r_results->race_results )
            ->with( 'set', $set )
            ->with( 'championship', $championship )
            ->with( 'simulator', $simulator )
            ->with('car_categories', $car_categories);
    }
}
