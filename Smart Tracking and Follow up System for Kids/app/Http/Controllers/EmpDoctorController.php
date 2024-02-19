<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChildDataResource;
use App\Http\Resources\ChildResource;
use App\Http\Resources\HealthDataOutResource;
use App\Http\Resources\HealthdatasetnameResource;
use App\Http\Resources\HealthdatasettypeResource;
use App\Http\Resources\HealthResource;
use App\Http\Resources\HealthTypeOutResource;
use App\Http\Resources\MidecalAnalysisResource;
use App\Http\Resources\PersonalCommentResource;
use App\Models\Child;
use App\Models\Employee;
use App\Models\Food;
use App\Models\Health;
use App\Models\Healthdatasetname;
use App\Models\Healthdatasettype;
use Illuminate\Http\Request;

class EmpDoctorController extends Controller
{
    //show child data for doctor the data in child profile
    public function showChildDataDoc($emp_id,$child_id,){
        $employee = Employee::where("id",$emp_id)->where("job_title" ,"!=" , "Seller")
        ->where("job_title" ,"!=" , "Teacher") //Doctor
        ->where('job_title', '!=', 'Specialist')
        ->first();
        if ($employee != null){
            $child = Child::where("id","=",$child_id)->first();
            if ($child != null) {
                return response()->json([
                "child Image"=>asset("storage")."/".$child->image,
                "Child Name" => $child->name,
                "Child Grade" => $child->grade,
                "Child Class" => $child->class,
                ]);
            } else {
                return response()->json([
                    "msg" => "child not found"
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "access denyed"
            ],404);
        }
    }

    //show child profile data
    public function showChildProfileDoc($emp_id,$child_id){
        $emp = Employee::where("id",$emp_id)->where("job_title" ,"!=" , "Seller")
        ->where("job_title" ,"!=" , "Teacher") 
        ->where('job_title', '!=', 'Specialist')
        ->first();
        if ($emp != null){
            $child = Child::where("id","=",$child_id)->first();
            if ($child != null) {
                return response()->json([
                "Child Name" => $child->name,
                "Age"=>$child->age,
                "child Image"=>asset("storage")."/".$child->image,
                "Weight"=>$child->weight,
                "Height"=>$child->height,
                "Child Grade" => $child->grade,
                "Child Class" => $child->class,
                ]);
            }else{
                return response()->json([
                    "msg" => "child not found",
                ],404);
            }
        }else{
            return response()->json([
                "msg" => "access denyed"
            ],404);
        }
    }

    //show health name that child has 
    public function showHealthNameDoc($emp_id,$child_id){
        $emp = Employee::where("id",$emp_id)->where("job_title" ,"!=" , "Seller")
        ->where("job_title" ,"!=" , "Teacher") //Doctor
        ->where('job_title', '!=', 'Specialist')
        ->first();
        if ($emp != null){
            $child = Child::where("id","=",$child_id)->first();
            if ($child != null) {
                $health=Health::where("child_id","=",$child_id)->get();
                if($health != null){
                    $dis_id=[];
                    foreach ($health as $all) {
                        $health_name = $all->healthHealthdatasetname;
                        foreach ($health_name as $name) {
                            $dis_id[] = [ 
                                "id"=>$name->id,
                                "name"=>$name->dis_name 
                                ]; 
                        }
                    }
                    return response()->json([
                        "Child Data"=> new ChildDataResource($child),
                        "dis"=>$dis_id,
                        "count"=>count($dis_id)
                    ]);  
                }else{
                    return response()->json([
                        "msg"=>"no data found"
                    ],404);
                }
            } else {
                return response()->json([
                    "msg" => "child not found"
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "access denyed"
            ],404);
        }
    }

    //show all health 
    public function showHealthDataDoc($emp_id, $child_id,$healthdatasetname_id){
        $emp = Employee::where("id", $emp_id)->where("job_title", "!=", "Seller")
        ->where("job_title", "!=", "Teacher") //Doctor
        ->where('job_title', '!=', 'Specialist')
        ->first();
        if ($emp != null) {
            $child = Child::where("id", "=", $child_id)->first();
            if ($child != null) {
                $health_name = Healthdatasetname::find($healthdatasetname_id);
                if ($health_name != null) {
                    $healthData = Health::where("child_id", "=", $child_id)->get();
                    $healths_ids=[];
                    foreach ($healthData as $key) {
                        $healths_ids[]= $key->id;
                    }
                    $health = $health_name->healthdatasetnameHealth()
                    ->wherePivot('healthdatasetname_id', $healthdatasetname_id)
                    ->wherePivotIn("health_id",$healths_ids)
                    ->get();
                    foreach ($healthData as $keh) {
                            $healthtype[] = $keh->healthHealthdatasettype()
                            ->select("dis_type")
                            ->wherePivot("health_id",$health->first()->id)
                            ->get();
                    }
                    if ($health != null) {
                        return response()->json([
                            "Health Name" => $health_name->dis_name,
                            "Health Type" =>$healthtype,
                            "Health Data" => new HealthDataOutResource($health[0]),
                        ], 200);
                    }else{
                        return response()->json([
                            "msg" => "no data found"
                        ], 404);
                    }
                }else {
                    return response()->json([
                        "msg" => "no data found"
                    ], 404);
                }
            }else {
                return response()->json([
                    "msg" => "Child don’t found"
                ], 404);
            }
        } else {
            return response()->json([
                "msg" => "Access denied"
            ], 404);
        }

    }

    //show  medical analysis {DONE} #19
    public function showHealthMedicalDoc($emp_id,$child_id,$healthdatasetname_id){
            $emp = Employee::where("id",$emp_id)->where("job_title" ,"!=" , "Seller")
            ->where("job_title" ,"!=" , "Teacher") //Doctor
            ->where('job_title', '!=', 'Specialist')
            ->first();
            if ($emp != null){
                $child = Child::where("id","=",$child_id)->first();
                if ($child != null) {
                    $health_name = Healthdatasetname::find($healthdatasetname_id);
                    if($health_name!=null){
                        //عشان نجيب ال فى بايفوت بال health name id
                        //وكده ال pivot_namedata فيه ال health_id ال يخص ال healthname_id دا 
                        $pivot_namedata= $health_name->healthdatasetnameHealth->first()->pivot->
                        where("healthdatasetname_id",$healthdatasetname_id)->get();
                        //ها اجيب ال داتا بتاعت ال healthid دا
                        $healthData = Health::where("child_id","=",$child_id)->where("id",$pivot_namedata->first()->health_id)->first();
                        // if($healthData!= null){
                            if($healthData->medical_analysis!=null){
                                return response()->json([
                                    "dis name"=>$health_name->dis_name,
                                    "Data" => new MidecalAnalysisResource($healthData),
                                    // "Datanu" => $pivot_namedata
                                ],200);
                            }else{
                                return response()->json([
                                    "msg"=>"has no medical uploaded"
                                ],404);
                            }
                        // }else{
                        //     return response()->json([
                        //         "msg"=>"has no health id"
                        //     ],404);
                        // }
                    }else{
                        return response()->json([
                            "dis_name"=> "health not found"
                        ],404);
                    }
                }else{
                    return response()->json([
                        "msg" => "child not found",
                    ],404);
                }
            }else{
                return response()->json([
                    "msg" => "access denyed"
                ],404);
            }
    }

    //show personal comment {DONE} #16
    public function showHealthCommentDoc($emp_id,$child_id,$healthdatasetname_id){
        $emp = Employee::where("id",$emp_id)->where("job_title" ,"!=" , "Seller")
        ->where("job_title" ,"!=" , "Teacher") //Doctor
        ->where('job_title', '!=', 'Specialist')
        ->first();
        if ($emp != null){
            $child = Child::where("id","=",$child_id)->first();
            if ($child != null) {
                $health_name = Healthdatasetname::find($healthdatasetname_id);
                if($health_name!=null){
                    // $healthData = Health::where("child_id","=",$child_id)->first();

                    //عشان نجيب ال فى بايفوت بال health name id
                    //وكده ال pivot_namedata فيه ال health_id ال يخص ال healthname_id دا 
                    $pivot_namedata= $health_name->healthdatasetnameHealth->first()->pivot->
                    where("healthdatasetname_id",$healthdatasetname_id)->get();
                    //ها اجيب ال داتا بتاعت ال healthid دا
                    $healthData = Health::where("child_id","=",$child_id)->where("id",$pivot_namedata->first()->health_id)->first();
                    if($healthData!= null){
                        //very important اهدى خالص.
                        // $pivot_namedata= $health_name->healthdatasetnameHealth->first()->pivot->
                        // where("health_id",$healthData->id)->
                        // where("healthdatasetname_id",$healthdatasetname_id)->get();
                        // //health id from pivot table healthdatasetname_health
                        // $health_id=$pivot_namedata->first()->health_id;
                        // $healthDatain = Health::where("id","=",$health_id)->first();
                        // if($healthDatain!=null){
                            return response()->json([
                                "dis name"=>$health_name->dis_name,
                                "Data" => new PersonalCommentResource($healthData)
                            ],200);
                        }else{
                            return response()->json([
                                "msg"=>"has no health id"
                            ],404);
                    }
                }else{
                     return response()->json([
                        "msg"=>"has no health id"
                    ],404);
                    }
            }else{
                return response()->json([
                    "dis_name"=> "child not found"
                ],404);
            }
        }else{
            return response()->json([
                "msg" => "access denyed"
            ],404);
        }
    }

    //show selected food 
    public function showSelectedFoodDoc($emp_id, $child_id){
        $emp = Employee::where("id",$emp_id)->where("job_title" ,"!=" , "Seller")
        ->where("job_title" ,"!=" , "Teacher") //Doctor
        ->where('job_title', '!=', 'Specialist')
        ->first();
        if ($emp != null){
            $child = Child::where("id", "=", $child_id)->first();
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

    //show banded food function {DONE}
    public function showBandedFoodDoc($emp_id, $child_id){
        $emp = Employee::where("id",$emp_id)->where("job_title" ,"!=" , "Seller")
        ->where("job_title" ,"!=" , "Teacher") //Doctor
        ->where('job_title', '!=', 'Specialist')
        ->first();
        if ($emp != null){
            $child = Child::where("id", "=", $child_id)->first();
            $bandedfood_id=[];
            $food_name=[];
            if ($child != null){
                foreach ($child->childBandedfood as $band) {
                    $bandedfood_id[] = $band->food_id;
                }
                foreach ($bandedfood_id as $b) {
                    $food_name[] = Food::select("id","name")->where("id",$b)->first();
                }
                if($child->image==null){
                    $imagename=null;
                }else{
                    $imagename=asset("storage")."/".$child->image;
                }
                if($food_name!=null){
                    return response()->json([
                        "child Image" => $imagename,
                        "Child Name" => $child->name,
                        "Child Grade" => $child->grade,
                        "Child Class" => $child->class,
                        "Banded Food"=>$food_name
                    ],200);
                }else{
                    return response()->json([
                        "msg" => "this child has no banded food"
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
