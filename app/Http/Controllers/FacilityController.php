<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Requests\FacilityRequest;

class FacilityController extends Controller
{
    public function lists($keyword,$count){
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = Facility::with('barangay')->where(function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('id','DESC')->paginate($count);
        return DefaultResource::collection($data);
    }

    public function store(FacilityRequest $request){
        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = Facility::with('barangay')->where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                $data = Facility::create($request->all());
                return $data;
            }
        });
        return new DefaultResource($data);
    }

    public function rooms(Request $request){
        $rooms = $request->room;
        $floor = $floor;
    }

    public function fetchRooms(){
        $data = Room::select( \DB::raw('count(*) as total'))->where('facility_id',1)->orderBy('floor','ASC')->groupBy('floor')->groupBy('is_avail')->get();
        return $data;
    }
}
