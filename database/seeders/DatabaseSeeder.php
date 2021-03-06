<?php

namespace Database\Seeders;

use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Rating::factory(50)->create();
        \App\Models\Size::factory(30)->create();
        $this->call([
            LanguageSeeder::class,
            TagSeeder::class,
            ProductSeeder::class,
            VoucherSeeder::class,
        ]);
    }
}
