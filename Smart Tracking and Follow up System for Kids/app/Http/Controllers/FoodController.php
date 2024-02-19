<?php

namespace App\Http\Controllers;

use App\Http\Resources\FoodResource;
use App\Models\Child;
use App\Models\Father;
use App\Models\Food;
use App\Models\Healthdatasetname;

class FoodController extends Controller
{
    // show all food for father {DONE} #7
    public function showAllFood($father_id,$child_id,$healthdatasetname_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                $health_name = Healthdatasetname::find($healthdatasetname_id);
                if($health_name!=null && $health_name->dis_name=="Food"){
                    $food = Food::all();
                    if($food!=null){
                        return FoodResource::collection($food);
                    }else{
                        return response()->json([
                            "msg"=>"data not found"
                        ],404);
                    }
                }else{
                     return response()->json([
                        "msg"=>"access denaied"
                    ],404);
                    }
            }else{
                return response()->json([
                    "dis_name"=> "you must set data for your child"
                ],404);
            }
        }else{
            return response()->json([
                "msg" => "you don't have account, please sign up first"
            ],404);
        }
    }

}
