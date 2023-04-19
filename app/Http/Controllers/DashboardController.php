<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard-world-wide');
    }

    public function show()
    {
        return view('dashboard.dashboard-by-country');
    }
}
