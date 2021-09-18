<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
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
        $practice = DB::table( 'practice' )->where( 'practice_id', '=', $id )->first();
        $p_results = DB::table( 'practice_result' )->where( 'practice_id', '=', $id )->get();

        return view( 'subsites.practice' )->with( 'practice', $practice )->with( 'p_results', $p_results );
    }
}
