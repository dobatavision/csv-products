<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
    public function index()
    {
        dd('here');
        return view('welcome');
    }
}
