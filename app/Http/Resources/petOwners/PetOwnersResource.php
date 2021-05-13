<?php

namespace App\Http\Resources\petOwners;

use Illuminate\Http\Resources\Json\JsonResource;

class PetOwnersResource extends JsonResource
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
            'Pet Owner ID' => $this->user_id,
            'Address' => $this->address,
            'Score' => $this->score,
        ];
    }
}
