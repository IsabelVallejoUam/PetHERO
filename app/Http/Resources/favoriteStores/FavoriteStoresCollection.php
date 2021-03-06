<?php

namespace App\Http\Resources\favoriteStores;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FavoriteStoresCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
                'links' => [
                'self' => '/api/v1/favoriteStores',
                ],
            ];
    }
}
