<?php

namespace App\Http\Resources\products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'ID'=> $this->id,
            'Store ID'=> $this->store_id,
            'Price'=> $this->price,
            'Name'=> $this->name,
            'Discount'=> $this->discount,
            'Quantiy Available'=> $this->quantity,
            'Description'=> $this->description,
            'Score'=> $this->score,
            "Product's Photo"=> $this->photo,
            'Privacy'=> $this->score,
            'Service of Product'=> $this->score, 
        ];
    }
}
