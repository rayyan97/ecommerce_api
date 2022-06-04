<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "product_name_en" => $this->faker->text(30),
            "product_name_hi" => $this->faker->text(30),
            "description_en" => $this->faker->text(),
            "description_hi" => $this->faker->text(),
            "price" => floatval(range(100, 500)),
            "vendor_id" => random_int(1, 10),
            "size_applicable" => true,
            'category_id' => random_int(1, 5)
        ];
    }
}
