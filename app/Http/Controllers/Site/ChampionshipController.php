<?php

namespace App\Http\Controllers\Site;

use App\Custom\Results\ChampionshipResults;
use App\Http\Controllers\Controller;
use App\Models\Championship;
use App\Models\Race_result;
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
        $race_categories = $championship->raceCategories()->get();
        $organizers = $championship->organizers()->get();
        $participation = $championship->participation()->orderBy('res_position')->orderBy('driver_last_name')->orderBy('driver_first_name')->get();
/*        $participation->transform( function( $item, $key ){
            $item->sum_points = $item->raceResults()->get()->sum( 'points' ) + $item->bonus_points;
            $item->class_order = $item->raceResults()->where( 'class_order', '>', 0 )->first() ? $item->raceResults()->where( 'class_order', '>', 0 )->first()->class_order : 0;
            $item->sum_class_points = $item->raceResults()->where( 'class_order', '>', 0 )->get()->sum( 'class_points' );
            return $item;
        } );*/
        $participation = $participation->sortByDesc( 'sum_points' );


        //TODO: Udělat dvě varianty sčítání: 1) Pořadí tříd ze setů (defaultní), 2) Race categories šampionátu (stejná kombinace cup+car category)


        return view( 'subsites.championship' )
            ->with( 'championship', $championship )
            ->with( 'race_categories', $race_categories )
            ->with( 'organizers', $organizers )
            ->with( 'participation', $participation );
    }


}
