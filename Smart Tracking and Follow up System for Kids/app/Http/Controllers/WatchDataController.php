<?php

namespace App\Http\Controllers;

use App\Http\Resources\WatchResource;
use App\Models\Child;
use App\Models\Watch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WatchDataController extends Controller
{
    //
    public function getHeartRate($child_code,Request $request){
        $child=Child::where("child_code",$child_code)->first();
        if($child != null){
            $va = Validator::make($request->all(),[           
                "heart_rate"=>"required|numeric",
            ]);
            if($va->fails()){
                return response()->json([
                    $va->errors()
                ],404);
            }else{
                $created=Watch::updateOrCreate(["child_id"=>$child->id],[
                    "heart_rate"=>$request->heart_rate,
                    "child_id"=>$child->id
                ]);
                return response()->json([
                     new WatchResource($created)
                ],200); 
            }
        }else{
            return response()->json([
                "msg" => "uncorrect child code"
            ],404);    
        }
    }
}
