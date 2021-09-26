<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{

    public function show( $id ){

        $user = User::findorFail( $id );
        //$memberships = $user->memberships()->get();
        //$teams= $memberships->team()->get();

        return view( 'subsites.user' )
            ->with( 'user', $user );
    }

}
