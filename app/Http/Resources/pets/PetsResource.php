<?php

namespace App\Http\Resources\pets;

use Illuminate\Http\Resources\Json\JsonResource;

class PetsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $link = "/api/v1/petOwner/{$this->owner_id}";

        return [
            'Pet ID'=>$this->id,
            'Pet Name'=> $this->name,
            'Type of Pet' => $this->species,
            'Race' => $this->race,
            'Pet Owner ID' => $this->owner_id,
            'Sex' => $this->sex,
            'Age' => $this->age,
            'Personality' => $this->personality,
            'Commentary' => $this->commentary,
            'Size'=> $this->size,
            'Photo' => $this->photo,
            'Pet Owner' => $link,
        ];
    }
}
