<?php

namespace App\Http\Resources\storeOwners;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreOwnersResource extends JsonResource
{

    public function user($id){
        $query = User::where('id',$id)->get();
        $query->toArray();
        return $query;
    
    }

    public function stores($id){
        $query = Store::where('owner_id',$id)->get();
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
        $stores =  $this->stores($this->user_id);
        
        return [
            'Store Owner ID' => $this->user_id,
            'Name' =>$user[0]->name,
            'Apellido' => $user[0]->lastname,
            'Phone Number' =>$user[0]->phone,
            'Email' =>$user[0]->email,
            'Stores' => $stores,
            'Link' =>  [
                'User' => "/api/v1/user/{$this->user_id}",
                'Store' => "/api/v1/store/user/{$this->user_id}",
                'self'  => "/api/v1/StoreOwner/{$this->user_id}",
                ]
        ];
    }
}
