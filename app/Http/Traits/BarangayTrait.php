<?php

namespace App\Http\Traits;
use App\Models\Barangay;
use App\Http\Resources\DefaultResource;

trait BarangayTrait {
    public function lists() {
        $data = Barangay::all();
        return DefaultResource::collection($data);
    }
}