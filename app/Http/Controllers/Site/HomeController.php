<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Championship;
use Illuminate\Http\Request;

class HomeController extends Controller{

    public function show(){

        $championships = Championship::where('highlight', 1)->get();

        return view('home')->with('championships', $championships);
    }

}
