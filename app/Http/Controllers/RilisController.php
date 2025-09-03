<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RilisController extends Controller
{
    function index()
    {
        return view('pages.rilis.index');
    }
}
