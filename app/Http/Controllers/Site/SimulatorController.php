<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Simulator;
use Illuminate\Http\Request;

class SimulatorController extends Controller{

    public function show($id){

        $simulator = Simulator::findorfail($id);

        return view('subsites.simulator')
            ->with('simulator', $simulator);
    }
}
