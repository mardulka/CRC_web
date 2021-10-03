<?php

namespace App\Http\Controllers\Site;

use App\Custom\Results\ChampionshipResults;
use App\Http\Controllers\Controller;
use App\Models\Championship;
use App\Models\Season;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChampionshipController extends Controller{

    /**
     * Returns view of championships list with seasons for sorting on page.
     *
     * @return Application|Factory|View
     */
    public function show_list(){

        $seasons = Season::orderByDesc( 'order' )->get();

        return view( 'sites.championships' )
            ->with( 'seasons', $seasons );
    }


    /**
     * Return main page for specific championship.
     *
     * @param $id
     *
     * @return Application|Factory|View
     */
    public function show( $id ){
        $championship = Championship::findOrFail( $id );
        $organizers = $championship->organizers()->get();
        $participation = $championship->participation()->get();
        $participation->transform( function( $item, $key ){
            $item->sum_points = $item->raceResults()->get()->sum( 'points' ) + $item->bonus_points;
            $item->class_order = $item->raceResults()->where('class_order', '>', 0)->first() ? $item->raceResults()->where('class_order', '>', 0)->first()->class_order : 0;
            $item->sum_class_points = $item->raceResults()->where('class_order', '>', 0)->get()->sum( 'class_points' );
            return $item;
        });
        $participation= $participation->sortByDesc('sum_points');



        return view( 'subsites.championship' )
            ->with( 'championship', $championship )
            ->with( 'organizers', $organizers )
            ->with( 'participation', $participation );
    }


}
