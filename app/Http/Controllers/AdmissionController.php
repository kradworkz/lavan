<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\User;
use App\Models\Notification;
use App\Models\PatientAdmission;
use App\Models\PatientAdmissionTest;
use App\Models\PatientAdmissionFacility;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\AdmissionResource;
use App\Services\SMSGateway;

class AdmissionController extends Controller
{
    public function index($keyword,$status,$count){
        $municipality_id = \Auth::user()->municipality_id;
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = PatientAdmission::with('facility','facility.bed.facility')->with('status')->with('patient')
        ->whereHas('patient',function ($query) use ($keyword) {
            $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%')->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', '%'.$keyword.'%');
        })
        ->whereHas('patient',function ($query) use ($municipality_id) {
            $query->whereHas('barangay',function ($query) use ($municipality_id) {
                $query->where('municipality_id',$municipality_id);
            });
        })
        ->where(function ($query) use ($status) {
            ($status == '-') ? '' : $query->where('status_id',$status);
            $query->where('is_released',0);
        })
        ->orderBy('id','DESC')->paginate($count);
        return AdmissionResource::collection($data);
    }

    public function store(SMSGateway $sms, Request $request){
        $data = \DB::transaction(function () use ($request,$sms){
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
                $notification = new Notification;
                $notification->content = 'New Admission';
                $notification->added_by = \Auth::user()->id;
                $notification->admission_id = $data->id;
                $notification->save();

                $municipality_id = \Auth::user()->municipality_id;
                $user = User::where('type','Isolation Manager')->where('municipality_id',$municipality_id)->first();
                if($data->is_home){
                    $message = 'Good day, New Patient '.$data->patient->firstname.' '.$data->patient->lastname.'. start home quarantine today.';
                    $sms->sendSMS($message, $user->mobile);
                }else{
                    $message = 'Good day, '.$user->name.'! New Patient '.$data->patient->firstname.' '.$data->patient->lastname.' at '.$data->facility->bed->facility->name.' on floor '.$data->facility->bed->floor.' room '.$data->facility->bed->name.', was admitted by '. \Auth::user()->name .', Thank you!';
                    $sms->sendSMS($message, $user->mobile);
                }

                return $data;
            }
        });
        return new AdmissionResource($data);
    }

    public function checkout(Request $request){
        $data = PatientAdmission::with('facility.bed')->where('id',$request->id)->first();

        if($request->died){
            $data->status_id = 3;
        }else{
            ($data->status_id == 1) ? $data->status_id = 2 : $data->status_id = 4;
        }
        $data->is_released = 1;
        if($data->save()){
            if(!$data->is_home){
                $bed = Bed::where('id',$data->facility->bed_id)->update(['is_available' => 1]);
            }
        }
        return $request->id;
    }

    public function test(Request $request){

        if($request->editable){
            $data = PatientAdmissionTest::find($request->id);
            $data->is_positive = $request->is_positive;
            if($data->save()){
                if($request->is_positive){
                    $pt = PatientAdmission::with('facility','facility.bed.facility')->with('status')->with('patient')->where('id',$request->admission_id)->first();
                    if(!$pt->is_home){
                        $bed = Bed::where('id',$pt->facility->bed_id)->update(['is_available' => 1]);
                        $bed = Bed::where('id',$request->bed_id)->update(['is_available' => 0]);
                        $pt->update($request->except(['editable','bed_id','admission_id']));
                        $pt->facility()->update($request->except(['editable','id','is_positive','status_id','admission_id']));
                    }else{
                        $bed = Bed::where('id',$request->bed_id)->update(['is_available' => 0]);
                        $pt->update($request->except(['editable','bed_id','admission_id']));
                        $pt->is_home = 0;
                        $pt->save();
                        $pt->facility()->create($request->except(['editable','id','is_positive','status_id','admission_id']));
                    }
                   
                }else{
                    $pt = PatientAdmission::with('facility','facility.bed.facility')->with('status')->with('patient')->where('id',$request->admission_id)->first();
                    $pt->is_positive = 0;
                    $pt->save();
                }

                $notification = new Notification;
                $notification->content = ($request->is_positive) ? 'Positive' : 'Negative';
                $notification->type = 2;
                $notification->added_by = \Auth::user()->id;
                $notification->admission_id = $data->id;
                $notification->save();
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
