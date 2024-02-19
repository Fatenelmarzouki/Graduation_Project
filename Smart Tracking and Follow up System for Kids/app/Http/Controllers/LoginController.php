<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\FatherResource;
use App\Models\Child;
use App\Models\Employee;
use App\Models\Father;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    //{DONE}
    public function access(LoginRequest $request){
        $father=Father::where("email","=",$request->email)->first();
        if($father != null){
            //check(new,old)
            $passCheck=Hash::check($request->password,$father->password);
            // $passCheck= ($request->password == $father->password);
            if($passCheck){
                //if ok ,update access token
                $access_token=Str::random(64);
                $father->update([
                    'access_token'=>$access_token
                ]);
                $child = Child::where("father_id",$father->id)->first();
                return response()->json([
                    "msg" => 'Hello',
                    "child"=> $child,
                    "Father Data"=> new FatherResource($father)
                ], 200);
            }else{
                return response()->json([
                    "msg" => 'access denied'
                ], 404);
            }
        }elseif($father == null){
            $emp = Employee::where("email","=",$request->email)->first();
            if($emp != null){
                //check(new,old)
                $passCheck=Hash::check($request->password,$emp->password);
                // $passCheck= ($request->password == $emp->password);
                if($passCheck){
                    //if ok ,update access token
                    $access_token=Str::random(64);
                    $emp->update([
                        'access_token'=>$access_token
                    ]);
                    return response()->json([
                        "Emp Data"=> new EmployeeResource($emp)
                    ], 200);
                }else{
                    return response()->json([
                        "msg" => 'access denied'
                    ], 404);
                }
            }else{
                return response()->json([
                    "msg" => "you don't have account"
                ], 404);
            }
        }
    }
    public function fakechild(){
        $faker = Faker::create();
        $childern = Child::limit(10)->get();
        foreach ($childern as $child) {
            $gender = $faker->randomElement(['male', 'female']);
            $child->update([
                "name" => $faker->firstName($gender),
                "grade" => 1,
                "gender" => $gender,
                "class" => "A",
                'activitydataset_id'=>$faker->numberBetween(1, 5),
            ]);
        }
        return "okey";
    }
    public function fake(){
        $faker = Faker::create();
        $childern = Child::limit(10)->get();
        foreach ($childern as $child) {
            $gender = $faker->randomElement(['male', 'female']);
            $child->update([
                "name" => $faker->firstName($gender),
                "grade" => 1,
                "gender" => $gender,
                "class" => "A",
                'activitydataset_id'=>$faker->numberBetween(1, 5),
            ]);
        }
        return "okey";
    }

}
