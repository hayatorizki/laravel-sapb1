<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        if(session()->get('cookies')==''){
            return redirect('login');
        }else{
            return view('home');
        }
    }
}
