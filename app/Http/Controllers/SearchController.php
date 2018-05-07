<?php

namespace App\Http\Controllers;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('search');
    }
}
