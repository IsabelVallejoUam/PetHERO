<?php

namespace App\Http\Resources\walkers;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class WalkersResource extends JsonResource
{

    public function user($id){
        $query = User::where('id',$id)->get();
        $query->toArray();
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
        $walker = $this->user($this->user_id);

        return [
            'Walker ID' => $this->user_id,
            'Name' =>$walker[0]->name,
            'Apellido' => $walker[0]->lastname,
            'Phone Number' =>$walker[0]->phone,
            'Email' =>$walker[0]->email,
            'Slogan' => $this->slogan,
            'Experience' => $this->experience,
            'Score' => $this->score,
            'Link' =>  [
                'User' => "/api/v1/user/{$this->user_id}",
                'self'  => "/api/v1/Walker/{$this->user_id}",
                ]
        ];
    }
}
