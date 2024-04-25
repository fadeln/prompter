<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            $this->mergeWhen($this->email,function(){
                return[
                    'name'=> $this->name,
                    'email'=> $this->email
                ];
            }),
            "favorites"=> FavoriteResource::collection($this->whenLoaded('favorites')),
            
            "favorites_count"=>$this->whenCounted('favorites'),
        ];
    }
}
