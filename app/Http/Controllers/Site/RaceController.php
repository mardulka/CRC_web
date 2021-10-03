<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Race;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
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
        $car_categories = $set->carCategories()->get();



        return view( 'subsites.race' )
            ->with( 'race', $race )
            ->with( 'championship', $championship )
            ->with( 'simulator', $simulator )
            ->with( 'car_categories', $car_categories );
    }
}
