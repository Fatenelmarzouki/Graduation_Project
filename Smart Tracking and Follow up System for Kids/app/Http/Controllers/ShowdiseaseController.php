<?php

namespace App\Http\Controllers;

use App\Http\Resources\HealthdatasetnameResource;
use App\Models\Child;
use App\Models\Father;
use App\Models\Healthdatasetname;

class ShowdiseaseController extends Controller
{
    //show all diseases {DONE}  #2(3)
    public function showDis($father_id,$child_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id", "=", $child_id)->first();
            if ($child != null){
                $diseases = Healthdatasetname::all();
                if($diseases!=null){
                    return HealthdatasetnameResource::collection($diseases);
                }else{
                    return response()->json([
                        "msg"=>"data not found"
                    ],404);
                }
            }else {
                return response()->json([
                    "msg" => "You must register data for your Child"
                ],404);
            }
        }else {
            return response()->json([
                "msg" => "You Don’t Have Account,Please Sign up First"
            ], 404);
        }

    }
}
