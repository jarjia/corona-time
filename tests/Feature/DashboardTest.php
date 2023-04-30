<?php

namespace Tests\Feature;

use App\Models\CountryStatistics;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $statistics;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->statistics = collect([
            CountryStatistics::factory()->create([
                'name' => ['en' => 'a', 'ka' => 'ა']
            ]),
            CountryStatistics::factory()->create([
                'name' => ['en' => 'ab', 'ka' => 'აბ']
            ]),
            CountryStatistics::factory()->create([
                'name' => ['en' => 'b', 'ka' => 'ბ']
            ]),
            CountryStatistics::factory()->create([
                'name' => ['en' => 'bc', 'ka' => 'ბგ']
            ]),
            CountryStatistics::factory()->create([
                'name' => ['en' => 'c', 'ka' => 'გ']
            ]),
            CountryStatistics::factory()->create([
                'name' => ['en' => 'cd', 'ka' => 'გდ']
            ]),
        ]);
        $this->actingAs($this->user);
    }

    public function test_dashboard_world_wide_should_be_accessible() 
    {
        $response = $this->get(route('dashboard.index'));

        $response->assertSuccessful();
        $response->assertViewIs('dashboard.dashboard-world-wide');
    }

    public function test_dashboard_by_country_should_be_accessible() 
    {
        $response = $this->get(route('dashboard.show'));

        $response->assertSuccessful();
        $response->assertViewIs('dashboard.dashboard-by-country');
    }

    public function test_dashboard_by_country_should_give_us_filtered_data_with_search_query() 
    {
        $response = $this->get(route('dashboard.show', ['search' => 'abc']));
        $data = $response->getOriginalContent()->getData();

        $filteredCountries = $this->statistics->filter(function($country) {
            return strpos(strtolower($country->name), strtolower('abc')) !== false;
        })->values();
    
        $this->assertEquals($filteredCountries->pluck('id'), $data['countries']->pluck('id'));
    }

    public function test_dashboard_by_country_should_give_us_sorted_data_by_name_in_english_locale() 
    {
        App::setLocale('en');
        $response = $this->get(route('dashboard.show', ['column' => 'name', 'direction' => 'desc']));
        $data = $response->getOriginalContent()->getData();

        $sortedCountries = CountryStatistics::query()->orderBy('name'.'->'.app()->getLocale(), 'desc')->get();

        $this->assertEquals($sortedCountries->pluck('id'), $data['countries']->pluck('id'));
    }

    public function test_dashboard_by_country_should_give_us_sorted_data_by_name_in_georgian_locale() 
    {
        App::setLocale('ka');
        $response = $this->get(route('dashboard.show', ['column' => 'name', 'direction' => 'desc']));
        $data = $response->getOriginalContent()->getData();

        $sortedCountries = CountryStatistics::query()->orderBy('name'.'->'.app()->getLocale(), 'desc')->get();

        $this->assertEquals($sortedCountries->pluck('id'), $data['countries']->pluck('id'));
    }

    public function test_dashboard_by_country_should_give_us_sorted_data_by_numeric_columns_in_descending() {
        $response = $this->get(route('dashboard.show', ['column' => 'new_cases', 'direction' => 'desc']));
        $data = $response->getOriginalContent()->getData();

        $sortedCountries = CountryStatistics::query()->orderBy('new_cases', 'desc')->get();

        $this->assertEquals($sortedCountries->pluck('id'), $data['countries']->pluck('id'));
    }

    public function test_dashboard_by_country_should_give_us_sorted_data_by_numeric_columns_in_ascending() {
        $response = $this->get(route('dashboard.show', ['column' => 'new_cases', 'direction' => 'asc']));
        $data = $response->getOriginalContent()->getData();

        $sortedCountries = CountryStatistics::query()->orderBy('new_cases', 'asc')->get();

        $this->assertEquals($sortedCountries->pluck('id'), $data['countries']->pluck('id'));
    }

    public function test_dashboard_by_country_should_give_correctly_filtered_and_sorted_data_by_name_in_english() 
    {
        App::setLocale('en');
        $response = $this->get(route('dashboard.show', ['column' => 'name', 'direction' => 'desc', 'search' => 'a']));
        $data = $response->getOriginalContent()->getData();

        $sortedCountries = CountryStatistics::query()->orderBy('name'.'->'.app()->getLocale(), 'desc')->get();

        $filteredCountries = $sortedCountries->filter(function($country) {
            return strpos(strtolower($country->name), strtolower('a')) !== false;
        })->values();

        $this->assertEquals($filteredCountries->pluck('id'), $data['countries']->pluck('id'));
    }

    public function test_dashboard_by_country_should_give_correctly_filtered_and_sorted_data_by_name_in_georgian() 
    {
        App::setLocale('ka');
        $response = $this->get(route('dashboard.show', ['column' => 'name', 'direction' => 'desc', 'search' => 'ა']));
        $data = $response->getOriginalContent()->getData();

        $sortedCountries = CountryStatistics::query()->orderBy('name'.'->'.app()->getLocale(), 'desc')->get();

        $filteredCountries = $sortedCountries->filter(function($country) {
            return strpos(strtolower($country->name), strtolower('ა')) !== false;
        })->values();

        $this->assertEquals($filteredCountries->pluck('id'), $data['countries']->pluck('id'));
    }

    public function test_dashboard_by_country_should_give_correctly_filtered_and_sorted_data_by_numeric_columns() 
    {
        $response = $this->get(route('dashboard.show', ['column' => 'new_cases', 'direction' => 'desc', 'search' => 'a']));
        $data = $response->getOriginalContent()->getData();

        $sortedCountries = CountryStatistics::query()->orderBy('new_cases', 'desc')->get();

        $filteredCountries = $sortedCountries->filter(function($country) {
            return strpos(strtolower($country->name), strtolower('a')) !== false;
        })->values();

        $this->assertEquals($filteredCountries->pluck('id'), $data['countries']->pluck('id'));
    }
}
