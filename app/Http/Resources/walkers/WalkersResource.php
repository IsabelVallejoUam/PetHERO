<?php

namespace App\Http\Resources\walkers;

use Illuminate\Http\Resources\Json\JsonResource;

class WalkersResource extends JsonResource
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
            'Walker ID' => $this->user_id,
            'Slogan' => $this->slogan,
            'Experience' => $this->experience,
            'Score' => $this->score,
        ];
    }
}
