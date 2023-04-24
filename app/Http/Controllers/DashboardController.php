<?php

namespace App\Http\Controllers;

use App\Models\CountryStatistics;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
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

    public function show(Request $request, UrlGenerator $url): View
    {    
        $data = CountryStatistics::query();
        $currentSortName = $request->query('sort');
        $currentSortCount = $request->query('sort_type');
        $urlParts = parse_url($url->previous());
        $queryParameters = [];
        if (array_key_exists('query', $urlParts)) {
            parse_str($urlParts['query'], $queryParameters);
        }
        $previousSortName = $queryParameters['sort'] ?? null;
        $newCount = $currentSortName === $previousSortName ? $currentSortCount += 1 : 0;

        if($newCount % 2 === 0 || $newCount === 0) {
            $sortType = 'desc';
        }else {
            $sortType = 'asc';
        }

        if($currentSortName === null || $currentSortName === 'name') {
            $sortField = "IFNULL(name->'$.".app()->getLocale()."', name)";
            $countries = $data->orderByRaw("$sortField $sortType")->get();
        } else {
            $countries = $data->orderBy($currentSortName, $sortType)->get();
        }

        $filteredCountries = $countries->filter(function($country) use ($request) {
            return strpos(strtolower($country->name), strtolower($request->query('search'))) !== false;
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
            'sort_type' => $sortType,
            'count' => $newCount,
            'new_cases' => $newcases,
            'recovered' => $recovered,
            'deaths' => $deaths
        ]);
    }
}