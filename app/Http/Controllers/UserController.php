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
                $data = User::with('municipality')->where('id',$request->id)->first();
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

    public function password(Request $request){

        if (!(\Hash::check($request->get('current_password'), \Auth::user()->password))) {
            return response()->json(['error' => "Password doesn't match."], 401);
        }

        if(strcmp($request->get('current_password'), $request->get('password')) == 0){
            return response()->json(['error' => 'Please choose a different password'], 401);
        }

        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:9|confirmed',
        ]);

        User::find(\Auth::user()->id)->update(['password'=> \Hash::make($request->input('password'))]);

        if(\Auth::user()->status == 'Inactive'){
            User::find(auth()->user()->id)->update(['status'=> 'Active']);
            return response()->json(['success' => 'First Attempt'], 200);
        }else{
            return response()->json(['success' => 'Password changed successfully !'], 200);
        }
    }

}
