<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Race_result;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{

    public function show( $id ){

        $user = User::findorFail( $id );
        $memberships = $user->memberships()->get();
        $user_rank = $user->userRanks()->WhereNull('until')->first();
        $race_results = $user->race_results()->get();


        return view( 'subsites.user' )
            ->with( 'user', $user )
            ->with('memberships', $memberships)
            ->with('user_rank', $user_rank)
            ->with('race_results', $race_results);
    }

}
