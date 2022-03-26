<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Bed;
use App\Models\Dropdown;
use App\Models\PatientAdmission;
use App\Models\PatientAdmissionTest;
use Illuminate\Http\Request;

class StatisticController extends Controller
{   
    public function index(){
        $array = [
            'facilities' => $this->facility(),
            'cases' => $this->cases(),
            'isolated' => $this->isolated(),
            'total' => $this->total()
        ];

        return $array;
    }

    public function facility(){
        $municipality_id = \Auth::user()->municipality_id;
        
        $facility = Facility::whereHas('barangay',function ($query) use ($municipality_id) {
            $query->where('municipality_id',$municipality_id);
        })->count();

        $occupied = Bed::where('is_available',0)
        ->whereHas('facility',function ($query) use ($municipality_id) {
            $query->whereHas('barangay',function ($query) use ($municipality_id) {
                $query->where('municipality_id',$municipality_id);
            });
        })
        ->count();

        $vacant = Bed::where('is_available',1)
        ->whereHas('facility',function ($query) use ($municipality_id) {
            $query->whereHas('barangay',function ($query) use ($municipality_id) {
                $query->where('municipality_id',$municipality_id);
            });
        })->count();

        $antigen = PatientAdmissionTest::where('is_rtpcr',0)->count();
        $rtpcr = PatientAdmissionTest::where('is_rtpcr',1)->count();

        $data = [
            "facility" => $facility,
            "occupied" => $occupied,
            "vacant" => $vacant,
            "total" => $occupied+$vacant,
            "swabs" => [
                'antigen' => $antigen,
                'rtpcr' => $rtpcr
            ]
        ];

        $counts = [];
        $types = ['Isolation Beds', 'Covid Beds'];
        for ($x = 0; $x <= 1; $x++) {
            $names = ['Occupied','Vacant'];
            $bed_type = []; $c = 0;
            for ($y = 0; $y <= 1; $y++) {
                $count = Bed::where(function ($query) use ($y) {
                    $query->where('is_available', $y);
                })
                ->whereHas('facility', function ($q) use ($x) {
                    $q->where('is_main',$x);
                })
                ->whereHas('facility',function ($query) use ($municipality_id) {
                    $query->whereHas('barangay',function ($query) use ($municipality_id) {
                        $query->where('municipality_id',$municipality_id);
                    });
                })
                ->count();

                $bed_type[] = [
                    'name' => $names[$y],
                    'count' => $count
                ];
                $c = $c + $count;
            } 
            $type[] = [
                'name' => $types[$x],
                'type' => $bed_type,
                'total' =>  $c
            ];
        }
        $array = [
           'facility' => $data,
           'beds' => $type
        ];
       return $array;
    
    }

    public function cases(){
        $municipality_id = \Auth::user()->municipality_id;
        $statuses = Dropdown::where('type','Status')->where('name','!=','Released')->orderBy('id','ASC')->get();
        $icons = ['bx bxs-virus','bx bxs-virus-block', 'bx bxs-ghost'];
        $array = [];
        foreach($statuses as $index => $status){
            $count = PatientAdmission::where('status_id',$status->id)
            ->whereHas('patient',function ($query) use ($municipality_id) {
                $query->whereHas('barangay',function ($query) use ($municipality_id) {
                    $query->where('municipality_id',$municipality_id);
                });
            })->count();
            $array[] = [
                'id' => $status->id,
                'name' => $status->name,
                'count' => $count,
                'color' => $status->color,
                'icon' => $icons[$index]
            ];
        }
        return $array;
    }

    public function isolated(){
        $municipality_id = \Auth::user()->municipality_id;
        $categories = Dropdown::where('type','Category')->orderBy('id','ASC')->get();
        $array = []; $c = 0;
        foreach($categories as $index => $category){
            $count = PatientAdmission::where('status_id',$category->id)
            ->whereHas('patient',function ($query) use ($municipality_id) {
                $query->whereHas('barangay',function ($query) use ($municipality_id) {
                    $query->where('municipality_id',$municipality_id);
                });
            })->where('is_released',0)->count();
            $array[] = [
                'id' => $category->id,
                'name' => $category->name,
                'count' => $count,
                'color' => $category->color,
                'total' => $c = $count + $count
            ];
        }
        return $array;
    }

    public function total(){
        $municipality_id = \Auth::user()->municipality_id;
        $active = PatientAdmission::where('is_positive',1)
        ->whereHas('patient',function ($query) use ($municipality_id) {
            $query->whereHas('barangay',function ($query) use ($municipality_id) {
                $query->where('municipality_id',$municipality_id);
            });
        })->count();
        $isolated = PatientAdmission::whereNull('is_positive')
        ->whereHas('patient',function ($query) use ($municipality_id) {
            $query->whereHas('barangay',function ($query) use ($municipality_id) {
                $query->where('municipality_id',$municipality_id);
            });
        })->where('is_released',0)->count();
        $home = PatientAdmission::where('is_home',1)
        ->whereHas('patient',function ($query) use ($municipality_id) {
            $query->whereHas('barangay',function ($query) use ($municipality_id) {
                $query->where('municipality_id',$municipality_id);
            });
        })->where('is_released',0)->count();
      
        $data = [
            'active' => $active,
            'isolated' => $isolated,
            'home' => $home
        ];
        return $data;
    }
}
