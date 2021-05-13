<?php

namespace App\Http\Resources\storeOwners;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreOwnersResource extends JsonResource
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
            'Store Owner ID' => $this->user_id,
        ];
    }
}
