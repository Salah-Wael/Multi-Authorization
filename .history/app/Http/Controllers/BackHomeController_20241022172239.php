<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackHomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('front.home');
    }
}
