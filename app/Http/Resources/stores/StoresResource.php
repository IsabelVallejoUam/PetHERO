<?php

namespace App\Http\Resources\stores;

use App\Models\StoreOwner;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\Product;


class StoresResource extends JsonResource
{
    
    public function StoreOwner($id){
        $query = User::where('id',$id)->get();
        return $query;
    
    }

    public function Products($id){
        $query = Product::where('store_id',$id)->get();
        return $query;
    
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){
       
        $owner = $this->StoreOwner($this->owner_id);
        $products = $this->Products($this->id);

        return [
            'ID'=> $this->id,
            'Name'=> $this->store_name,
            'Slogan'=> $this->slogan,
            'Nit'=> $this->nit,
            'Schedule'=> $this->schedule,
            'Address'=> $this->address,
            'Phone Number'=> $this->phone_number,
            'Description'=> $this->description,
            'Score'=> $this->score,
            "Store's Photo"=> $this->photo,
            'Privacy'=> $this->privacy,
            "Type of Establishment"=> $this->type,
            'Owner'=> $owner,
            'Products'=>$products,

        ];
    }

}
