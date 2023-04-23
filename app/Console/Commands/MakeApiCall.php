<?php

namespace App\Console\Commands;

use App\Models\CountryStatistics;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class MakeApiCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corona-time:make-api-call';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command makes api call every 24 hour.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $getresponse = Http::get('https://devtest.ge/countries');

        $countries = $getresponse->json();

        foreach ($countries as $country) {
            $postResponse = Http::post('https://devtest.ge/get-country-statistics', [
                'code' => $country['code']
            ])->json();

            CountryStatistics::updateOrCreate(
                ['code' => $postResponse['code']],
                [
                    'country' => $postResponse['country'],
                    'new_cases' => $postResponse['confirmed'],
                    'recovered' => $postResponse['recovered'],
                    'deaths' => $postResponse['deaths'],
                    'name' => [
                        'en' => $country['name']['en'],
                        'ka' => $country['name']['ka'],
                    ],
                ]
            );
        }
    }
}
