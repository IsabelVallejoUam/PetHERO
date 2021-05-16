<?php

namespace App\Http\Resources\favoriteStores;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteStoresResource extends JsonResource
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
            'User ID' => $this->user_id,
            'Store ID' => $this->store_id,
        ];
    }
}
