<?php

namespace App\Traits;

use App\Models\Language;
use Illuminate\Http\Request;

trait CheckLang
{

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function checkLang(Request $request)
    {
        $header = $request->header('lang');
        //$languages = collect(Language::get())->pluck('lang_code');
        $languages = ['en', 'hi'];

        if (in_array($header, $languages)) {
            $lang = $header;
        } else {
            $lang = 'en';
        }
        return $lang;
    }
}
