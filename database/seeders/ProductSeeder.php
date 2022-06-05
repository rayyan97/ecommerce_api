<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->product_name_en = $this->faker->text(30);
            $product->product_name_hi = $this->faker->text(30);
            $product->description_en = $this->faker->text();
            $product->description_hi = $this->faker->text();
            $product->price = floatval(range(100, 500));
            $product->vendor_id = random_int(1, 10);
            $product->size_applicable = true;
            $product->category_id = random_int(1, 5);
            $product->save();
            $tag_id = [1, 2, 3, 4, 5, 6, 7, 8];
            $product->tags()->sync($tag_id);
        }
    }
}
