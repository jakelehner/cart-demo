<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'sku' => $this->sku,
            'displayName' => $this->display_name,
            'unitCost' => $this->unit_cost,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}