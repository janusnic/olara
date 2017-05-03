<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class HomeController extends Controller
{
        /**
        * Create a new controller instance.
        *
        * @return void
        */
        public function __construct()
        {
            //$this->middleware('isAdmin');
            $this->middleware('auth');
        }
       /**
       * Show the application dashboard.
       *
       * @return \Illuminate\Http\Response
       */
       public function index()
       {
           //dd( Auth::guard('admin')->user());
           return view('home.index');
       }
}
