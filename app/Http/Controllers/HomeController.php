<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }

    public function voters(){
        try{
            $voters = DB::table('voters')->where('committee',auth()->user()->CommitteeID)->get();
            $voted = DB::table('voters')
                ->where('committee',auth()->user()->CommitteeID)
                ->where('is_voted',1)
                ->count();
            $notvoted = DB::table('voters')
                ->where('committee',auth()->user()->CommitteeID)
                ->where('is_voted',0)
                ->count();
            return view('voters.index',['voters'=>$voters,'voted'=>$voted,'notvoted'=>$notvoted]);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
