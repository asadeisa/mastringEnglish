<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class LoginController extends Controller
{
    //
    public function index()
    {
        # code...
        // return view("auth.login");
        if(auth()->user()->is_admin ==1 )
        {
           
            return redirect()->route('Dachbord');
        }
        else if(auth()->user()->teacher ==1)
        {
            return redirect()->route('teacher');
        }
        else if(auth()->user()->teacher != 1 && auth()->user()->is_admin !=1 && auth()->user()->level == null )
        {
            return redirect()->route('level-test');

        }
        else{
            return redirect()->route('home');
        }
    }
}
