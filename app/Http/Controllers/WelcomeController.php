<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth,
    DB;
use App\NewWippli;
use App\BusinessDetail;
use App\Role;

class WelcomeController extends Controller {

    public function __construct() {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function landing_index() {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('sites.index');
    }



}
