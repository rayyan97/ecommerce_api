<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Size as ProductSize;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\Tag as TagResource;
use App\Models\Category;
use App\Models\Language;
use App\Traits\CheckLang;

class Product extends JsonResource
{
    use CheckLang;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'product_name' => $this->{'product_name_' . $this->checkLang($request)},
            'description' => $this->{'description_' . $this->checkLang($request)},
            'price' => $this->price,
            'available_sizes' => ($this->size_applicable == 1) ? $this->whenLoaded('sizes') : null,
            'rating' => (count($this->ratings) > 0) ? round($this->ratings->sum('rating') / count($this->ratings), 2) : null,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'tags' => $this->whenLoaded('tags')
        ];
    }
}
