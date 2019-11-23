<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'userFingerprint' => $this->user_fingerprint,
            'numItemsTotal' => $this->items->sum('pivot.quantity'),
            'numItemsUnique' => count($this->items),
        ];

        $this->relationLoaded('items')
            ? $data['items'] = CartItemResource::collection($this->items)
            : $data['items'] = [];
        
        return $data;
    }
}