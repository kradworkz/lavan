<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdmissionResource extends JsonResource
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
            'is_home' => $this->is_home,
            'exit_port' => $this->exit_port,
            'started_at' => $this->started_at,
            'completion_at' => $this->completion_at,
            'status' => $this->status,
            'facility' => $this->facility,
            'patient_name' => $this->patient->lastname.', '.$this->patient->firstname.' '.$this->patient->middlename.'.',
            'patient_address' => $this->patient->address,
            'is_released' => $this->is_released,
            'is_positive' => $this->is_positive,
            'tests' => $this->tests,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
