<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Practice;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PracticeController extends Controller{

    /**
     * Return main page for specific practice.
     *
     * @param $id
     *
     * @return Application|Factory|View
     */
    public function show( $id ){
        $practice = Practice::findOrFail( $id );
        $p_results = $practice->practiceResults()->get();
        $race = $practice->race()->first();
        $set = $race->set()->first();
        $championship = $set->championship()->first();

        return view( 'subsites.practice' )
            ->with( 'practice', $practice )
            ->with( 'p_results', $p_results )
            ->with( 'race', $race )
            ->with( 'set', $set )
            ->with( 'championship', $championship );
    }
}
