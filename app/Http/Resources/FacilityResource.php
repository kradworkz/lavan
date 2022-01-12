<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacilityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'is_main' => $this->is_main,
            'barangay' => $this->barangay,
            'available' => $this->available(),
            'beds' => $this->bedcount(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
