<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function carrier()
    {
        return view('carrier');
    }

    public function contact()
    {
        return view('contact');
    }
}