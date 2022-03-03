<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class MunicipalityController extends Controller
{
    public function index($keyword,$count){
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = Municipality::where(function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('id','DESC')->paginate($count);
        return DefaultResource::collection($data);
    }

    public function lists()
    {
        $data = Municipality::all();
        return DefaultResource::collection($data);
    }


    public function store(Request $request)
    {
        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = Municipality::where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                $data = Municipality::create($request->all());
                return $data;
            }
        });
        return new DefaultResource($data);
    }

    public function view($id){
        $data = Municipality::with('barangays')->where('id',$id)->first();
        return new DefaultResource($data);
    }

    public function storeb(Request $request)
    {
        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = Barangay::where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                $data = Barangay::create($request->all());
                return $data;
            }
        });
        return new DefaultResource($data);
    }
}
