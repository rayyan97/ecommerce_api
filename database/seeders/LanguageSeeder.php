<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lang = ['en' => 'English', 'hi' => 'Hindi'];

        foreach ($lang  as $key => $value) {
            $data = new Language();
            $data->language = $value;
            $data->lang_code = $key;
            $data->save();
        }
    }
}
