<?php

namespace App\Http\Controllers;

class GreetingController extends Controller
{
    /**
     * Display a greeting message.
     */
    public function hello()
    {
        return view('greeting.hello');
    }
}
