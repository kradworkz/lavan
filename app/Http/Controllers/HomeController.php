<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\ListExpense;
use Illuminate\Http\Request;
use App\Exports\EntryExport;
use App\Imports\ScholarImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\BarangayTrait;
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

}
