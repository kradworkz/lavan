<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\PatientAdmission;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\AdmissionResource;

class AdmissionController extends Controller
{
    public function index($keyword,$status,$count){
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = PatientAdmission::with('bed','bed.facility')->with('status')->with(['patient' => function ($query) use ($keyword){
            $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%')->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', '%'.$keyword.'%');
        }])
        ->where(function ($query) use ($status) {
            ($status == '-') ? '' : $query->where('status_id',$status);
            $query->where('is_released',0);
        })
        ->orderBy('id','DESC')->paginate($count);
        return AdmissionResource::collection($data);
    }

    public function store(Request $request){
        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = PatientAdmission::with('bed','bed.facility')->with('status')->with('patient')->where('id',$request->id)->first();
                $bed = Bed::where('id',$data->bed_id)->update(['is_available' => 1]);
                $data->update($request->except('editable'));
                $bed = Bed::where('id',$request->bed_id)->update(['is_available' => 0]);
                return $data;
            }else{
                $data = PatientAdmission::create($request->all());
                if($data){
                    $bed = Bed::where('id',$request->bed_id)->update(['is_available' => 0]);
                }
                $data = PatientAdmission::with('bed','bed.facility')->with('status')->with('patient')->where('id',$data->id)->first();
                return $data;
            }
        });
        return new AdmissionResource($data);
    }

    public function checkout(Request $request){
        $data = PatientAdmission::where('id',$request->id)->update(['is_released' => 1]);
        return $request->id;
    }
}
