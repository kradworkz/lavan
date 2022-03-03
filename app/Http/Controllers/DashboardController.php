<?php

namespace App\Http\Controllers;

use App\Models\PatientAdmissionTest;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class DashboardController extends Controller
{
    public function testLists(){
        $data = PatientAdmissionTest::where('is_positive',NULL)->with('admission.patient')->get();
        return DefaultResource::collection($data);
    }
}
