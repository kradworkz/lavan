<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Notification;
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

    public function notifications(){
        $municipality_id = \Auth::user()->municipality_id;
        $role = \Auth::user()->type; 
        $query = Notification::query();
        $query->with('admission.patient')->with('user');
        $query->where('is_seen',0);
        $query->whereHas('admission',function ($query) use ($municipality_id) {
            $query->whereHas('patient',function ($query) use ($municipality_id) {
                $query->whereHas('barangay',function ($query) use ($municipality_id) {
                    $query->where('municipality_id',$municipality_id);
                });
            });
        });
        ($role == 'Contact Tracer') ? $query->where('type',2) : $query->where('type',1) ; 
        ($role == 'Contact Tracer') ? $query->where('added_by','!=',\Auth::user()->id) : '' ; 
        $data = $query->get();

        return $data;
    }

    public function seen($id){
        $data = Notification::where('id',$id)->first();
        $data->is_seen = 1;
        $data->save();
    }

}
