<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ResourcesProduct;
use App\Models\Language;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $header = $request->header('lang');
        $languages = collect(Language::get())->pluck('lang_code');

        if (in_array($header, $languages->toArray())) {
            $lang = $header;
        } else {
            $lang = 'en';
        }
        $request->lang = $lang;
        return ResourcesProduct::collection(Product::with('sizes', 'ratings', 'category', 'tags')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
