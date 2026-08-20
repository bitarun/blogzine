<?php

namespace Database\Factories;

use App\Models\TrafficStat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TrafficStatFactory extends Factory
{
    protected $model = TrafficStat::class;

    public function definition(): array
    {
        return [
            'visit' => fake()->dateTimeBetween('-12 months', 'now')->format('Y-m-d'),
        ];
    }
}
