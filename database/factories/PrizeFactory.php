<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PrizeFactory extends Factory
{
    public function definition()
    {
        return [
            'numbers' => collect(range(0, 5))->map(fn () => rand(1, 60))->toArray(),
        ];
    }
}
