<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Race_result;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{

    public function show( $id ){

        $user = User::findorFail( $id );
        $country = $user->country()->first();
        $teams = $user->teams()->get();
        $licenses = $user->licenses()->first();
        $active_license = $user->licenses()->whereNull('until')->first();
        $race_results = $user->race_results()->get();


        return view( 'subsites.user' )
            ->with( 'user', $user )
            ->with( 'country', $country )
            ->with('teams', $teams)
            ->with('licenses', $licenses)
            ->with('active_license', $active_license)
            ->with('race_results', $race_results);
    }

}
