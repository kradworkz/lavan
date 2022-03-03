<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\PatientAdmission;
use App\Models\PatientAdmissionTest;
use App\Models\PatientAdmissionFacility;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\AdmissionResource;

class AdmissionController extends Controller
{
    public function index($keyword,$status,$count){
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = PatientAdmission::with('facility','facility.bed.facility')->with('status')->with('patient')
        ->whereHas('patient',function ($query) use ($keyword) {
            $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%')->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', '%'.$keyword.'%');
        })
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
                $data = PatientAdmission::with('facility','facility.bed.facility')->with('status')->with('patient')->where('id',$request->id)->first();
                $bed = Bed::where('id',$data->bed_id)->update(['is_available' => 1]);
                $data->update($request->except('editable'));
                $data->facility()->update(array_merge(["bed_id" => $request->bed_id,"admission_id" => $request->id]));
                $bed = Bed::where('id',$request->bed_id)->update(['is_available' => 0]);
                return $data;
            }else{
                $data = PatientAdmission::create($request->all());
                if($data){
                    if(!$request->is_home){
                        $paf = PatientAdmissionFacility::create(array_merge($request->all(),['admission_id' => $data->id]));
                        $bed = Bed::where('id',$request->bed_id)->update(['is_available' => 0]);
                    }
                }
                //with('bed','bed.facility')
                $data = PatientAdmission::with('facility','facility.bed.facility')->with('status')->with('patient')->where('id',$data->id)->first();
                return $data;
            }
        });
        return new AdmissionResource($data);
    }

    public function checkout(Request $request){
        $data = PatientAdmission::with('facility.bed')->where('id',$request->id)->first();
        ($data->status_id == 1) ? $data->status_id = 2 : '';
        $data->is_released = 1;
        if($data->save()){
            $bed = Bed::where('id',$data->facility->bed_id)->update(['is_available' => 1]);
        }
        return $request->id;
    }

    public function test(Request $request){

        if($request->editable){
            $data = PatientAdmissionTest::find($request->id);
            $data->is_positive = $request->is_positive;
            if($data->save()){
                if($request->is_positive){
                    $data = PatientAdmission::with('facility','facility.bed.facility')->with('status')->with('patient')->where('id',$request->admission_id)->first();
                    $bed = Bed::where('id',$data->facility->bed_id)->update(['is_available' => 1]);
                    $bed = Bed::where('id',$request->bed_id)->update(['is_available' => 0]);
                    $data->update($request->except(['editable','bed_id','admission_id']));
                    $data->facility()->update($request->except(['editable','id','is_positive','status_id','admission_id']));
                }
            }
        }else{
            $count = PatientAdmissionTest::where('admission_id',$request->id)->where('is_positive',NULL)->count();

            if($count == 0){
                $data = new PatientAdmissionTest;
                $data->is_rtpcr = ($request->test == 'RT-PCR') ? 1 : 0;
                $data->admission_id = $request->id;
                $data->save();
            }
        }
    }
    
}
