<?php

namespace App\Http\Resources\walks;

use App\Models\PetOwner;
use App\Models\Walker;

use Illuminate\Http\Resources\Json\JsonResource;

class WalksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $owner = $this->PetOwner($this->user_id);
        $walker = $this->Walker($this->walker);

        if($walker == null){
            $walker = "No Walker Assigned Yet";
        }

        return [
            'Walk ID' => $this->id,
            'Pet ID' => $this->pet_id,
            'PetOwner' => $owner,
            'Walker' => $walker,
            'Day of the Walk' => $this->requested_day,
            'Hour of the Walk' => $this->requested_hour,
            'Minutes Walked' => $this->minutes_walked,
            'Route' => $this->route,
            'Minimum Hours of Walk' => $this->min_time,
            'Maximum  Hours of Walk' => $this->max_time,
            'Walk Commentary' => $this->commentary,
            'Walk Status' => $this->status,
            'Did Walker Confirm' => $this->walker_confirmation,
            'Was the Walk Cancelled' => $this->cancel_confirmation,
            'Pet Calification' => $this->pet_calification,
            'Walker Calification' => $this->walker_calification,
            
        ];
    }

    public function Walker($id){
        $query = Walker::where('user_id',$id)->get();
        return $query;
    
    }

    public function PetOwner($id){
        $query = PetOwner::where('user_id',$id)->get();
        return $query;
    
    }
}
