<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class ContactController extends Controller{


    public function show(){

        $roles = Role::all();
        $organizers = $roles->where( 'name', 'Organizer' )->first()->users()->get();
        $marshals = $roles->where( 'name', 'Marshal' )->first()->users()->get();
        $admins = $roles->where( 'name', 'Admin' )->first()->users()->get();

        return view( 'sites.contacts' )
            ->with( 'roles', $roles )
            ->with( 'organizers', $organizers )
            ->with( 'marshals', $marshals )
            ->with( 'admins', $admins );
    }

}
