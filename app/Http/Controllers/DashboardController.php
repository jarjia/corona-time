<?php

namespace App\Http\Controllers;

use App\Models\CountryStatistics;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        $cases = CountryStatistics::all();
        $newcases = 0;
        $recovered = 0;
        $deaths = 0;
        
        foreach($cases as $case) {
            $newcases += $case->new_cases;
            $recovered += $case->recovered;
            $deaths += $case->deaths;
        }
        return view('dashboard.dashboard-world-wide', [
            'new_cases' => $newcases,
            'recovered' => $recovered,
            'deaths' => $deaths
        ]);
    }

    public function show(Request $request): View
    {    
        $allCountries = CountryStatistics::all();
        $countries = CountryStatistics::filter(
            ['search' => request('search'), 'column' => request('column'), 'direction' => request('direction')], request())
        ->get();

        $newcases = 0;
        $recovered = 0;
        $deaths = 0;
       
        foreach($allCountries as $country) {
            $newcases += $country->new_cases;
            $recovered += $country->recovered;
            $deaths += $country->deaths;
        }

        return view('dashboard.dashboard-by-country', [
            'countries' => $countries,
            'new_cases' => $newcases,
            'recovered' => $recovered,
            'deaths' => $deaths
        ]);
    }
}