<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\PatientResource;
use App\Http\Requests\PatientRequest;

class PatientController extends Controller
{
    public function index($keyword,$count){
        $municipality_id = \Auth::user()->municipality_id;
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = Patient::with('histories')->with('barangay')->where(function ($query) use ($keyword) {
            $query->where('firstname', 'LIKE', '%'.$keyword.'%')
            ->orWhere('lastname', 'LIKE', '%'.$keyword.'%')
            ->orWhere('middlename', 'LIKE', '%'.$keyword.'%');
        })
        ->whereHas('barangay',function ($query) use ($municipality_id) {
            $query->where('municipality_id',$municipality_id);
        })
        ->orderBy('id','DESC')->paginate($count);
        return PatientResource::collection($data);
    }

    public function store(PatientRequest $request){
        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = Patient::with('histories')->with('barangay')->where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                $data = Patient::create($request->all());
                $data = Patient::with('histories')->with('barangay')->where('id',$data->id)->first();
                return $data;
            }
        });
        return new PatientResource($data);
    }

    public function view($id){
        $data = Patient::with('histories','histories.facility.bed.facility','histories.status','histories.tests')->with('barangay')->where('id',$id)->first();
        return new PatientResource($data);
    }

    public function search(Request $request){
        $keyword = $request->word;
        $data = Patient::where(function ($query) use ($keyword) {
            $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%')->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('id','DESC')->paginate(5);
        return DefaultResource::collection($data);
    }
}
