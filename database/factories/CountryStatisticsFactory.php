<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CountryStatisticsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerKa = FakerFactory::create('ka_GE');

        return [
            'name' => ['en' => fake()->word(), 'ka' => $fakerKa->realText(10)],
            'code' => strtoupper(Str::random(2)),
            'country' => fake()->word(),
            'new_cases' => fake()->numberBetween(100, 10000),
            'deaths' => fake()->numberBetween(100, 10000),
            'recovered' => fake()->numberBetween(100, 10000),
        ];
    }
}
