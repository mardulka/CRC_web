<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller{

    public function show( $id ){

        $team = Team::findorFail( $id );
        $memberships = $team->memberships()->get();

        return view( 'subsites.team' )
            ->with( 'team', $team )
            ->with('memberships', $memberships);
    }

}
