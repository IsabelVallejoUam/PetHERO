<?php

namespace App\Http\Resources\favoriteWalkers;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteWalkersResource extends JsonResource
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
            'User ID' => $this->pet_owner_id,
            'Walker ID' => $this->walker_id,
        ];
    }
}
