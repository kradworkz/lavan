<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\PatientAdmission;
use App\Http\Traits\BarangayTrait;
use App\Services\SMSGateway;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class HomeController extends Controller
{
    use BarangayTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {   
        $barangays = $this->lists();
        return view('home')->with('barangays',$barangays);   
    }

    public function index()
    {   
        $role = \Auth::user()->type;
        if(Auth::user()->type == "Administrator"){
            return view('user_common.password');
        }else if($role == "Super Administrator"){
            return view('user_admin.index');    
        }else if($role == "Scholarship Coordinator"){
            return view('user_admin.index');    
        }else if($role == "Scholarship Staff"){
            return view('user_admin.index');    
        }else{
            return view('user_admin.index');    
        }
    }

    public function test(SMSGateway $sms)
    {
        $lists = PatientAdmission::with('facility.bed.facility')->with('patient')->where('completion_at',today())->get();
        foreach($lists as $list){  
            if($list->is_home){
                $message = 'Good day, '.$list->patient->firstname.' '.$list->patient->lastname.'. Your quarantine period has ended. Keep safe always..                                 
                
-Rural Health Unit

Thank you!';
                $sms->sendSMS($message, $list->patient->mobile);
            }else{
                $message = 'Good day, '.$list->patient->firstname.' '.$list->patient->lastname.'. Your quarantine period has ended.';
                $sms->sendSMS($message, $list->patient->mobile);
    
                $municipality_id = $list->patient->barangay->municipality_id;
                $user = User::where('type','Isolation Manager')->where('municipality_id',$municipality_id)->first();
                
                $message = 'Good day, '.$user->name.'! Patient '.$list->patient->firstname.' '.$list->patient->lastname.' at '.$list->facility->bed->facility->name.' on floor '.$list->facility->bed->floor.' room '.$list->facility->bed->name.', will be released today. Kindly Assist the patient, Thank you!';
                $sms->sendSMS($message, $user->mobile);
            } 
        }
    }

}
