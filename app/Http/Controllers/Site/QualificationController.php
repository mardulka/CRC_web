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
        $q_results = $qualification->qualifyResults()->orderBy('best_lap')->orderBy('man_position')->get();
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
