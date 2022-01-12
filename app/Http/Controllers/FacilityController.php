<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\FacilityResource;
use App\Http\Requests\FacilityRequest;

class FacilityController extends Controller
{
    public function index($keyword,$count){
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = Facility::with('barangay')->where(function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('is_main','DESC')->paginate($count);
        return FacilityResource::collection($data);
    }

    public function store(FacilityRequest $request){
        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = Facility::with('barangay')->where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                $data = Facility::create($request->all());
                $data = Facility::with('barangay')->where('id',$data->id)->first();
                return $data;
            }
        });
        return new FacilityResource($data);
    }

    public function view($id){
        $data = Facility::with('barangay')->where('id',$id)->first();
        return new FacilityResource($data);
    }

    public function fetchBeds($id){
        // $data = Room::select('floor', \DB::raw('count(*) as total'))->where('facility_id',$id)->groupBy('floor')->get();
        $data = [];
        $collection = Bed::where('facility_id',$id)->get();
        $grouped = $collection->groupBy(function ($item, $key) {
            return substr($item['floor'], 0);
        });
        foreach($grouped as $key=>$group){
            $data[] = [
                'floor' => $key,
                'beds' => $group->chunk(10)
            ];
        }
        return $data;
    }

    public function storeBed(Request $request){
       $lists = $request->input('lists');

        foreach($lists as $list){
            for($x = 1; $x <= $list['bed']; $x++) {
                $data = new Bed;
                $data->name = $x;
                $data->floor = $list['floor'];
                $data->facility_id = $request->id;
                $data->save();
            }
       }
    }

    public function search(Request $request){
        $keyword = $request->word;
        $data = Facility::with('barangay')->where(function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->with(['beds' => function ($query){
            $query->where('is_available', 1);
        }])
        ->orderBy('id','DESC')->paginate(5);
        return DefaultResource::collection($data);
    }

    public function type($type){
        
        $data = Facility::with('beds')->where(function ($query) use ($type) {
            $query->where('is_main', $type);
        })
        ->orderBy('id','DESC')->get();
        return DefaultResource::collection($data);
    }

}
