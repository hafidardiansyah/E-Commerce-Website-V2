<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RandomController extends Controller
{
    public function about()
    {
        return view('random.about');
    }

    public function gallery()
    {
        return view('random.gallery');
    }
}
