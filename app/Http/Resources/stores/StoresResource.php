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
        // $link = "/api/v1/products/{$id}";
        // $query->push($link);
        return $query;
    
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){
       
        $products = $this->Products($this->id);
        $link = "/api/v1/storeowners/{$this->owner_id}";

        return [
            'ID'=> $this->id,
            'Owner ID'=> $this->owner_id,
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
            'Owner Link'=>$link,
            'Products'=>$products,

        ];
    }

}
