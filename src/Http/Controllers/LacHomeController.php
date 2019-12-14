<?php

namespace Kdion4891\Lac\Http\Controllers;

use App\Http\Controllers\Controller;

class LacHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('lac::auth.home');
    }
}
