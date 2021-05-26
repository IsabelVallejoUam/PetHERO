<?php

namespace App\Http\Resources\favoritePets;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoritePetsResource extends JsonResource
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
            'ID in Table' => $this->id,
            'Walker ID' => $this->walker_id,
            'Pet ID' => $this->pet_id,
        ];
    }
}
