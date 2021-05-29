<?php

namespace App\Http\Resources\petOwners;

use App\Models\User;
use App\Models\Pet;
use Illuminate\Http\Resources\Json\JsonResource;

class PetOwnersResource extends JsonResource
{
    public function user($id){
        $query = User::where('id',$id)->get();
        $query->toArray();
        return $query;
    
    }

    public function pets($id){
        $query = Pet::where('owner_id',$id)->get();
        return $query;
    
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $this->user($this->user_id);
        $pets = $this->pets($this->user_id);

        return [
            'Pet Owner ID' => $this->user_id,
            'Name' =>$user[0]->name,
            'Apellido' => $user[0]->lastname,
            'Phone Number' =>$user[0]->phone,
            'Email' =>$user[0]->email,
            'Address' => $this->address,
            'Score' => $this->score,
            'Pets' => $pets,
            'Link' =>  [
                'User' => "/api/v1/user/{$this->user_id}",
                'Pets' => "/api/v1/pets/user/{$this->user_id}",
                'self'  => "/api/v1/PetOwner/{$this->user_id}",
                ]
        ];
    }
}
