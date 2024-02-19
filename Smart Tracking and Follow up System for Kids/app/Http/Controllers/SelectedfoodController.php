<?php

namespace App\Http\Controllers;

use App\Http\Resources\BandedFoodResource;
use App\Http\Resources\SelectedfoodResource;
use App\Models\Bandedfood;
use App\Models\Child;
use App\Models\Employee;
use App\Models\Father;
use App\Models\Food;
use App\Models\Healthdatasetname;
use App\Models\Selectedfood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SelectedfoodController extends Controller
{
    //we change selectedfood table to selectedfoods {Done}
    public function insertSelectedFood($father_id,$child_id,$healthdatasetname_id,Request $request){
        //validation
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                $health_name = Healthdatasetname::find($healthdatasetname_id);
                if($health_name!=null && $health_name->dis_name=="Food"){
                    $foods = Food::all();
                    $food_id=[];
                    foreach ($foods as $food) {
                        $food_id[]=$food->id;
                    }
                    $validator = Validator::make($request->all(), [
                        "count" => 'numeric|max:5|nullable',
                        "food"=>[Rule::in($food_id)],
                    ]);
                    if ($validator->fails()) {
                        return response()->json([
                            'msg' => $validator->errors()
                        ], 409);
                    }
                    //create 
                    else{
                        //foreach need
                        $count= Selectedfood::create([
                            "food_id"=>$request->food,
                            'count'=>$request->count
                        ]);
                        $selectedfood = Child::where("id","=",$child_id)->first();
                        $count->selectedfoodChild()->syncWithoutDetaching($selectedfood->id);
                        //msg
                        return response()->json([
                            'msg' => 'count Inserted Successfully',
                            'count' => new SelectedfoodResource($count),
                        ], 200);
                    }
                }else{
                     return response()->json([
                        "msg"=>"access denaied"
                    ],404);
                }
            }else{
                return response()->json([
                    "msg" => "you must register data for your child",
                ],404);
            }
        }else{
            return response()->json([
                "msg" => "you don't have account, please sign up first"
            ],404);
        }
    }

    //to insert banded food {DONE}
    public function insertBandedFood($father_id,$child_id,$healthdatasetname_id,Request $request){
        //validation
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                $health_name = Healthdatasetname::find($healthdatasetname_id);
                if($health_name!=null && $health_name->dis_name=="Food"){
                    $foods = Food::all();
                    $food_id=[];
                    foreach ($foods as $food) {
                        $food_id[]=$food->id;
                    }
                    $validator = Validator::make($request->all(), [
                        "food"=>[Rule::in($food_id)],
                    ]);
                    if ($validator->fails()) {
                        return response()->json([
                            'msg' => $validator->errors()
                        ], 409);
                    }
                    //create 
                    else{
                        //foreach need
                        $count= Bandedfood::create([
                            "food_id"=>$request->food,
                        ]);
                        $bandedfood = Child::where("id","=",$child_id)->first();
                        $count->bandedfoodChild()->syncWithoutDetaching($bandedfood->id);
                        //msg
                        return response()->json([
                            'msg' => 'count Inserted Successfully',
                            'count' => new BandedFoodResource($count),
                        ], 200);
                    }
                }else{
                     return response()->json([
                        "msg"=>"access denaied"
                    ],404);
                }
            }else{
                return response()->json([
                    "msg" => "you must register data for your child",
                ],404);
            }
        }else{
            return response()->json([
                "msg" => "you don't have account, please sign up first"
            ],404);
        }
    }
    
    //show allowed food for seller
    public function showBandedFoodSeller($emp_id, $qr_string){
        $emp = Employee::where("id", $emp_id)
        ->where("job_title","=","Seller")
        ->first();
        if ($emp != null) {
            $child = Child::where("qr_string", "=", $qr_string)->first();
            $bandedfood_id = [];
            $food_name = [];
            if ($child != null) {
                foreach ($child->childBandedfood as $band) {
                    $bandedfood_id[] = $band->food_id;
                }
                foreach ($bandedfood_id as $b) {
                    $food_name[] = Food::select("id", "name")->where("id", $b)->first();
                }
                if ($child->image == null) {
                    $imagename = null;
                } else {
                    $imagename = asset("storage") . "/" . $child->image;
                }
                if ($food_name != null) {
                    return response()->json([
                        "child Image" => $imagename,
                        "Child Name" => $child->name,
                        "Child Grade" => $child->grade,
                        "Child Class" => $child->class,
                        "Banded Food" => $food_name
                    ], 200);
                } else {
                    return response()->json([
                        "msg" => "this child has no banded food"
                    ], 404);
                }
            } else {
                return response()->json([
                    "msg" => "child not found"
                ], 404);
            }
        } else {
            return response()->json([
                "msg" => "access denyed"
            ],
                404
            );
        }
    }

    //show selected food for seller
    public function showSelectedFoodSeller($emp_id, $qr_string){
        $emp = Employee::where("id",$emp_id)->where("job_title" , "Seller")
        ->first();
        if ($emp != null){
            $child = Child::where("qr_string", "=", $qr_string)->first();
            if ($child != null){
                $selected=$child->childSelectedfood;
                if ($selected != null) {
                    $arr1=[];
                    $arr2=[];
                    foreach($selected as $all){
                            $arr1[] = $all->selectedfoodFood->name;
                            $status_food = $all->count;
                            $arr2[] = $status_food;
                        }
                        return response()->json([
                            "child Image" => asset("storage")."/".$child->image,
                            "Child Name" => $child->name,
                            "Child Grade" => $child->grade,
                            "Child Class" => $child->class,
                            "food_name"=>$arr1,
                            "count"=>$arr2
                        ]);
                    }else{
                        return response()->json([
                            "msg" => "No Food Exist"
                        ],404);
                    }
            }else {
                    return response()->json([
                        "msg" => "child not found"
                    ],404);
            }
        }else {
                return response()->json([
                    "msg" => "access denyed"
                ], 404);
        }
    }
}
