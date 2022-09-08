<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'numbers' => collect(range(0, 5))->map(fn () => rand(1, 60)),
            'winner' => fake()->boolean(20),
            'code' => fake()->uuid()
        ];
    }
}
