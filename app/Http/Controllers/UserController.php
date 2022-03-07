<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\LogResource;
use App\Http\Requests\UserRequest;
use Spatie\Activitylog\Models\Activity;
use App\Jobs\EmailNewAccount;

class UserController extends Controller
{
    public function lists($keyword,$count){
        (\Auth::user()->type == 'Super Administrator') ? $type = ['Administrator'] : $type = ['Contact Tracer', 'Isolation Manager'];
        ($keyword == '-') ? $keyword = '' : $keyword;
        $query = User::query();
        $query->with('municipality')->where(function ($query) use ($keyword) {
            $query->where('email', 'LIKE', '%'.$keyword.'%')->orWhere('name','LIKE','%'.$keyword.'%');
        });
        (\Auth::user()->type == 'Administrator') ? $query->where('municipality_id',\Auth::user()->municipality_id) : '';
        $query->whereIn('type',$type);
        $data = $query->orderBy('id','DESC')->paginate($count);
        return UserResource::collection($data);
    }

    public function store(UserRequest $request){
        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = User::findOrFail($request->id);
                $data->update($request->except('editable'));
                return $data;
            }else{
                (\Auth::user()->type == 'Administrator') ? $municipality = \Auth::user()->municipality_id : $municipality = $request->municipality_id;
                $data = User::create(array_merge($request->all(), ['municipality_id' => $municipality,'password' => bcrypt('lavan2022')]));
                // EmailNewAccount::dispatch($data->id)->delay(now()->addSeconds(10));
                $data = User::with('municipality')->where('id',$data->id)->first();
                return $data;
            }
        });
        return new UserResource($data);
    }

    public function myLogs($keyword,$count){
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = Activity::with('causer','causer.profile','subject')
        ->whereHas('causer',function ($query) use ($keyword) {
            $query->whereHas('profile',function ($query) use ($keyword) {
                $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%')->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', '%'.$keyword.'%');
            });
        })
        ->where('causer_id',\Auth::user()->id)->orderBy('created_at','DESC')->paginate($count);
        return LogResource::collection($data);
    }
}
