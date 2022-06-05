<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['Shirt', 'T-Shirt', 'Jeans', 'Party Wear', 'Casual', 'Formals', 'Watch', 'Glass'];
        foreach ($tags as $key => $value) {
            $tag = new Tag();
            $tag->name = $value;
            $tag->save();
        }
    }
}
