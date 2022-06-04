<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'category_name_en' => $this->faker->text(30),
            'category_name_hi' => $this->faker->text(30),
            'description_hi' => $this->faker->text(),
            'description_en' => $this->faker->text()

        ];
    }
}
