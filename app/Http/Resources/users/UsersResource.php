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
            'ID' => $this->id,
            'Name' => $this->name,
            'Lastname' => $this->lastname,
            'Email' => $this->email,
            'Document' => $this->document,
            'Phone' => $this->phone,
            'Avatar photo' => '/public/uploads/avatars/'.$this->avatar,
            'Created_at' => $this->created_at,            
            //'updated_at' => $this->updated_at,
        ];
    }
}
