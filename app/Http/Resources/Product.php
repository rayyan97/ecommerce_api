<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
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
            'product_name' => $this->{'product_name_' . $request->lang},
            'description' => $this->{'description_' . $request->lang},
            'price' => $this->price,
            'size' => [
                'id' => $this->sizes->id,
                'size' => $this->sizes->size
            ]
        ];
    }
}
