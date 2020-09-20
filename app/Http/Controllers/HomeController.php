<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        return view('home');
    }

    function panel(){
        return view('home');
    }

    function dashboard(){
        return view('home');
    }
}
