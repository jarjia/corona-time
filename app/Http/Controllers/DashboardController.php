<?php

namespace App\Http\Controllers;

use App\Models\CountryStatistics;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

class DashboardController extends Controller
{
    public function index()
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

    public function show(Request $request)
    {    
        $currentSortName = $request->query('sort');   
        $currentSortType = $request->query('type');
        $joinedData = CountryStatistics::join('country_codes', 'country_statistics.code', '=', 'country_codes.code');

        if($currentSortName === 'name') {
            $countries = $joinedData->orderByRaw("country_codes.name->'$.".app()->getLocale()."' ".$currentSortType)->get();
        }else if($currentSortName === null) {
            $countries = $joinedData->get();
        }else {
            $countries = $joinedData->orderBy($currentSortName, $currentSortType)->get();
        }

        $filteredCountries = $countries->filter(function($country) use ($request) {
            return strpos(strtolower($country->countryCodes->name), strtolower($request->query('search'))) !== false;
        });

        $newcases = 0;
        $recovered = 0;
        $deaths = 0;
       
        foreach($countries as $country) {
            $newcases += $country->new_cases;
            $recovered += $country->recovered;
            $deaths += $country->deaths;
        }

        return view('dashboard.dashboard-by-country', [
            'countries' => $filteredCountries,
            'sort_name' => $currentSortName,
            'sort_type' => $currentSortType,
            'new_cases' => $newcases,
            'recovered' => $recovered,
            'deaths' => $deaths
        ]);
    }

    public function sorting(Request $request, UrlGenerator $url)
    {
        $sort = $request->query('sort');
        $previousSortType = strpos($url->previous(), $sort) !== false 
        && strpos($url->previous(), 'asc') === false ? 'asc' : 'desc';
        
        $params = ['sort' => $sort, 'type' => $previousSortType];

        if ($request->has('search')) {
            $params['search'] = $request->query('search');
        }

        return redirect()->route('dashboard.show', $params);
    }
}