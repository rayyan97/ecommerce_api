<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sizes = ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
        $index = array_rand($sizes);
        $value = $sizes[$index];
        return [
            "product_id" => random_int(1, 10),
            "size" =>  $value
        ];
    }
}
