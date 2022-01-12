<?php

namespace App\Http\Controllers;

use App\Models\Dropdown;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class DropdownController extends Controller
{
    public function index($type,$keyword,$count){
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = Dropdown::where('type',$type)
        ->where(function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('id','DESC')->paginate($count);
        return DefaultResource::collection($data);
    }

    public function lists($type)
    {
        $query = Dropdown::query();
        $data = $query->where('type',$type)->get();
        return DefaultResource::collection($data);
    }


    public function store(Request $request)
    {
        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = Dropdown::where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                $data = Dropdown::create($request->all());
                return $data;
            }
        });
        return new DefaultResource($data);
    }
}
