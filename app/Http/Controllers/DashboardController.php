<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Municipality;
use App\Models\PatientAdmission;
use App\Models\PatientAdmissionTest;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class DashboardController extends Controller
{   
    public function index(){
        $array = [
            'tests' => $this->testLists(),
            'releasing' => $this->releasing(),
            'swab' => $this->swab()
        ];

        return $array;
    }

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

    public function swab(){
        $municipality_id = \Auth::user()->municipality_id;
        
        // $data = PatientAdmissionTest::with('admission.patient')->where('is_rtpcr',0)->where('is_positive',1)
        // ->whereHas('admission.patient',function ($query) use ($municipality_id) {
        //     $query->whereHas('barangay',function ($query) use ($municipality_id) {
        //         $query->where('municipality_id',$municipality_id);
        //     });
        // })->get();
        $data = PatientAdmission::with('patient','status')->where('is_released',0)
        ->whereHas('tests',function ($query){
            $query->where('is_rtpcr',0)->where('is_positive',1)->where('is_old',0);
        })
        ->whereHas('patient',function ($query) use ($municipality_id) {
            $query->whereHas('barangay',function ($query) use ($municipality_id) {
                $query->where('municipality_id',$municipality_id);
            });
        })->get();

        return DefaultResource::collection($data);
    }

    public function admin(){
        $municipality = Municipality::count();
        $facility = Facility::count();

        $data = [
            'municipality' => $municipality,
            'facility' => $facility
        ];
        return $data;
    }
}
