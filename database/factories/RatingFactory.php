<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "product_id" => random_int(1, 10),
            "user_id" => random_int(1, 10),
            "rating" => floatval(range(1, 5))
        ];
    }
}
