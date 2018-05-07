<?php

namespace App\Http\Controllers;

class ArticleController extends Controller
{
    public function show($n)
    {
        return view('article')->with('numero', $n);
    }

}
