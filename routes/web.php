<?php

use App\Http\Controllers\Site\ChampionshipController;
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
Route::get( '/', function(){
    return view( 'home' );
} )->name( 'home' );

Route::get( 'news', function(){
    return view( 'sites.news' );
} )->name( 'news' );

Route::get( 'championships', [ChampionshipController::class, 'show'] )
    ->name( 'championships' );

Route::get( 'stats', function(){
    return view( 'sites.stats' );
} )->name( 'stats' );

Route::get( 'rules', function(){
    return view( 'sites.rules' );
} )->name( 'rules' );

Route::get( 'contacts', function(){
    return view( 'sites.contacts' );
} )->name( 'contacts' );

//----------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * Backup routes
 */
Route::get( '/dashboard', function(){
    return view( 'dashboard' );
} )->middleware( [ 'auth' ] )->name( 'dashboard' );

require __DIR__ . '/auth.php';
