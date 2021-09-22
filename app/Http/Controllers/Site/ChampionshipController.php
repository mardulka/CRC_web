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
        $drivers = DB::table( 'participation' )->where( 'participation.championship_id', '=', $id )
                     ->leftJoin( 'user', 'user.user_id', '=', 'participation.user_id' )
                     ->leftJoin( 'crew', 'crew.crew_id', '=', 'participation.crew_id' )
                     ->leftJoin( 'team', 'team.team_id', '=', 'participation.team_id' )
                     ->get();

        $ch_results = new ChampionshipResults( $id );
        $ch_results->load_results()->combine();


        return view( 'subsites.championship' )
            ->with( 'championship', $championship )
            ->with( 'organizers', $organizers )
            ->with( 'drivers', $drivers )
            ->with( 'ch_results', $ch_results->champ_results );
    }


}
