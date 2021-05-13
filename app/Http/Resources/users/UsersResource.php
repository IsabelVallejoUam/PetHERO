<?php

namespace App\Http\Resources\users;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'document' => $this->document,
            'phone' => $this->phone,
            'avatar' => '/public/uploads/avatars/'.$this->avatar,
            'created_at' => $this->created_at,            
            //'updated_at' => $this->updated_at,
        ];
    }
}
