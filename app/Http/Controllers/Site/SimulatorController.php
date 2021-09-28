<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Simulator;
use Illuminate\Http\Request;

class SimulatorController extends Controller{

    public function show( $id ){

        $simulator = Simulator::findorfail( $id );
        $circuits = $simulator->circuit_layouts()
                              ->join( 'circuit', 'circuit_layout.circuit_id', '=', 'circuit.circuit_id' )
                              ->join( 'country', 'circuit.country_id', '=', 'country.country_id' )
                              ->select( 'circuit_layout.name as layout_name',
                                        'circuit_layout.year as layout_year',
                                        'circuit.name as circuit_name',
                                        'country.name as country_name',
                                        'circuit.fictional as circuit_fictional')
                              ->orderBy( 'circuit.name' )
                              ->orderBy( 'circuit_layout.name' )
                              ->orderByDesc( 'circuit_layout.year' )
                              ->get();
        $cars = $simulator->cars()->join( 'car_category', 'car.car_category_id', '=', 'car_category.car_category_id' )
                          ->join( 'car_type', 'car.car_type_id', '=', 'car_type.car_type_id' )
                          ->join( 'manufacturer', 'car_type.manufacturer_id', '=', 'manufacturer.manufacturer_id' )
                          ->select( 'car.name as car_name', 'manufacturer.name as manufacturer_name' )
                          ->orderBy( 'manufacturer.name' )
                          ->orderBy( 'car_type.name' )
                          ->get();

        return view( 'subsites.simulator' )
            ->with( 'simulator', $simulator )
            ->with( 'circuits', $circuits )
            ->with( 'cars', $cars );
    }
}
