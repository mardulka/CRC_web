<?php

use App\Http\Controllers\Site\ChampionshipController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\PracticeController;
use App\Http\Controllers\Site\QualificationController;
use App\Http\Controllers\Site\RaceController;
use App\Http\Controllers\Site\SimulatorController;
use App\Http\Controllers\Site\TeamController;
use App\Http\Controllers\Site\UserController;
use App\Models\Car;
use App\Models\Car_category;
use App\Models\Car_type;
use App\Models\Circuit;
use App\Models\Circuit_layout;
use App\Models\Country;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//----------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * Basic routes for nav items
 */
Route::get( '/', [ HomeController::class, 'show' ] )
     ->name( 'home' );

Route::get( 'news', function(){
    return view( 'sites.news' );
} )->name( 'news' );

Route::get( 'championships', [ ChampionshipController::class, 'show_list' ] )
     ->name( 'championships' );

Route::get( 'stats', function(){
    return view( 'sites.stats' );
} )->name( 'stats' );

Route::get( 'rules', function(){
    return view( 'sites.rules' );
} )->name( 'rules' );

Route::get( 'contacts', [ ContactController::class, 'show' ] )
     ->name( 'contacts' );


//----------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * Special sites routes
 */

Route::get( 'championship/{id}', [ ChampionshipController::class, 'show' ] )->name( 'championship' );
Route::get( 'race/{id}', [ RaceController::class, 'show' ] )->name( 'race' );
Route::get( 'qualification/{id}', [ QualificationController::class, 'show' ] )->name( 'qualification' );
Route::get( 'practice/{id}', [ PracticeController::class, 'show' ] )->name( 'practice' );

Route::get( 'user/{id}', [ UserController::class, 'show' ] )->name( 'user' );
Route::get( 'team/{id}', [ TeamController::class, 'show' ] )->name( 'team' );
Route::get( 'simulator/{id}', [ SimulatorController::class, 'show' ] )->name( 'simulator' );


//----------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * Routes without controllers
 */
Route::get( 'circuit/{id}', function( $id ){
    return view( 'subsites.circuit' )->with( 'circuit', Circuit::findorfail( $id ) );
})->name('circuit');
//------------------------------------------
Route::get( 'circuit_layout/{id}', function( $id ){
    return view( 'subsites.circuit_layout' )->with( 'circuit_layout', Circuit_layout::findorfail( $id ) );
} )->name('circuit_layout');
//------------------------------------------
Route::get( 'car_category/{id}', function( $id ){
    return view( 'subsites.car_category' )->with( 'car_category', Car_category::findorfail( $id ) );
} )->name('car_category');
//------------------------------------------
Route::get( 'car/{id}', function( $id ){
    return view( 'subsites.car' )->with( 'car', Car::findorfail( $id ) );
} )->name('car');
//------------------------------------------
Route::get( 'car_type/{id}', function( $id ){
    return view( 'subsites.car_type' )->with( 'car_type', Car_type::findorfail( $id ) );
} )->name('car_type');
//------------------------------------------
Route::get( 'manufacturer/{id}', function( $id ){
    return view( 'subsites.manufacturer' )->with( 'manufacturer', Manufacturer::findorfail( $id ) );
} )->name('manufacturer');
//------------------------------------------
Route::get( 'country/{id}', function( $id ){
    return view( 'subsites.country' )->with( 'country', Country::findorfail( $id ) );
} )->name('country');

//----------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * Backup routes
 */
Route::get( '/dashboard', function(){
    return view( 'dashboard' );
} )->middleware( [ 'auth' ] )->name( 'dashboard' );

require __DIR__ . '/auth.php';
