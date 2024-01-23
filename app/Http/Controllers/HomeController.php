<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(session()->has('user_role') && session()->get('user_role')==0){
            $soluong_phim = Movie::count();
            $soluong_user  = User::where('role',1)->count();
            return view('home',compact('soluong_phim','soluong_user'));
            
        }
        else
        {
            return redirect()->route('login');
        }

    }
}
