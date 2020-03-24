<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return session('errors');
       // return view('home');
    }
    public function t(){
        return view('home.t');
    }
    public function tt(Request $request){
        $request->validate([
            'title' => 'bail|required|unique:tasks|max:255',
            'content' => 'required',
        ]);
    }
}
