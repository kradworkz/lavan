<?php

namespace App\Http\Traits;
use App\Models\Barangay;
use App\Http\Resources\DefaultResource;

trait BarangayTrait {
    public function lists() {
        $data = Barangay::where('municipality_id',\Auth::user()->municipality_id)->get();
        return DefaultResource::collection($data);
    }
}