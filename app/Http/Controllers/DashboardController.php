<?php

namespace App\Http\Controllers;

use App\Models\PatientAdmission;
use App\Models\PatientAdmissionTest;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class DashboardController extends Controller
{
    public function testLists(){
        $municipality_id = \Auth::user()->municipality_id;
        $data = PatientAdmissionTest::where('is_positive',NULL)->with('admission.patient')
        ->whereHas('admission',function ($query) use ($municipality_id) {
            $query->whereHas('patient',function ($query) use ($municipality_id) {
                $query->whereHas('barangay',function ($query) use ($municipality_id) {
                    $query->where('municipality_id',$municipality_id);
                });
            });
        })->get();
        return DefaultResource::collection($data);
    }

    public function releasing(){
        $municipality_id = \Auth::user()->municipality_id;

        $data = PatientAdmission::with('patient','status')->where('is_released',0)
        ->whereHas('patient',function ($query) use ($municipality_id) {
            $query->whereHas('barangay',function ($query) use ($municipality_id) {
                $query->where('municipality_id',$municipality_id);
            });
        })->get();

        return DefaultResource::collection($data);
    }
}
