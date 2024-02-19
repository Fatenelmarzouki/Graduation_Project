<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChildDataResource;
use App\Http\Resources\HealthDataOutResource;
use App\Http\Resources\MidecalAnalysisResource;
use App\Http\Resources\PersonalCommentResource;
use App\Http\Resources\PostResource;
use App\Models\Child;
use App\Models\Employee;
use App\Models\Health;
use App\Models\Healthdatasetname;
use App\Models\Post;
use Illuminate\Http\Request;

class EmpSpecialistController extends Controller
{
    //show all children
    public function showAllChildSpecialist($emp_id, $grade, $class){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Specialist")
            ->first();
        if ($emp != null) {
            $childs = Child::where("grade", $grade)->where("class", $class)->get();
            if (count($childs) != 0) {
                return response()->json([
                    'all children' => ChildDataResource::collection($childs),
                ],200);
            }else{
                return response()->json([
                    "msg" => "No Data Here"
                ],404);
            }
        }else{
            return response()->json([
                "msg" => "Data Not Found"
            ],404);
        }
    }

    //show one child
    public function showChildProfileSpecialist($emp_id, $grade, $class, $child_id){
        $emp =Employee::where("id", $emp_id)
            ->where("job_title", "Specialist")
            ->first();
        if ($emp != null) {
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null) {
                if ($child->image == null) {
                    $imagename = null;
                } else {
                    $imagename = asset("storage") . "/" . $child->image;
                }
                return response()->json([
                    "Child Name" => $child->name,
                    "Age" => $child->age,
                    "child Image" => $imagename,
                    "Weight" => $child->weight,
                    "Height" => $child->height,
                    "Child Grade" => $child->grade,
                    "Child Class" => $child->class,
                ],200);
            } else {
                return response()->json([
                    "msg" => "Data Not Found",
                ], 404);
            }
        } else {
            return response()->json([
                "msg" => "you don’t have permission to access here"
            ], 404);
        }
    }

    //show all posts for emp {DONE}
    public function showPostWithReplay($emp_id, $grade, $class, $child_id){
        $emp = Employee::where("id", "=", $emp_id)->where("job_title", "=", "Specialist")->first();
        if ($emp != null){ //$emp only equal to true
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if($child != null){
                $posts = Post::where("child_id", "=", $child_id)->get();
                if (count($posts) != 0) {
                    return response()->json([
                       "posts"=> PostResource::collection($posts)
                    ]); 
                } else {
                    return response()->json([
                        "msg" => "No Posts Here"
                    ]);
                }
            }else{
                return response()->json([
                    "msg" => "child not exist"
                ]);
            }
        } else {
            return response()->json([
                "msg" => "You are Not Valid To Access Here "
            ]);
        }
    }

    //show health name
    public function showHealthNameSpecialist($emp_id, $grade, $class, $child_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Specialist")
            ->first();
        if ($emp != null) {
            $child = Child::where("id", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null) {
                $health = Health::where("child_id", "=", $child_id)->get();
                if ($health != null) {
                    $dis_id = [];
                    foreach ($health as $all) {
                        $health_name = $all->healthHealthdatasetname;
                        foreach ($health_name as $name) {
                            $dis_id[] = [
                                "id" => $name->id,
                                "name" => $name->dis_name
                            ];
                        }
                    }
                    if (count($dis_id) != 0) {
                        return response()->json([
                            "Child Data" => new ChildDataResource($child),
                            "dis" => $dis_id,
                            "count" => count($dis_id)
                        ],200);
                    } else {
                        return response()->json([
                            "Child Data" => new ChildDataResource($child),
                            "dis" => null,
                            "count" => count($dis_id)
                        ],200);
                    }
                } else {
                    return response()->json([
                        "msg" => "no data found"
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
            ], 404);
        }
    }

    //show medical anaylsis
    public function showHealthMedicalSpecialist($emp_id, $grade, $class, $child_id, $healthdatasetname_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Specialist")
            ->first();
        if ($emp != null) {
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null) {
                $health_name = Healthdatasetname::find($healthdatasetname_id);
                if ($health_name != null) {
                    $pivot_namedata = $health_name->healthdatasetnameHealth->first()->pivot->where("healthdatasetname_id", $healthdatasetname_id)->get();
                    $healthData = Health::where("child_id", "=", $child_id)->where("id", $pivot_namedata->first()->health_id)->first();
                    if($healthData != null){
                        if ($healthData->medical_analysis != null) {
                            return response()->json([
                                "dis name"=>$health_name->dis_name,
                                "Data" => new MidecalAnalysisResource($healthData),
                            ], 200);
                        } else {
                            return response()->json([
                                "msg" => "has no medical uploaded"
                            ], 404);
                        }
                    }else{
                        return response()->json([
                            "msg" => "error in your health data"
                        ], 404);
                    }
                } else {
                    return response()->json([
                        "dis_name" => "health not found"
                    ], 404);
                }
            } else {
                return response()->json([
                    "msg" => "child dosen't exist"
                ], 404);
            }
        } else {
            return response()->json([
                "msg" => "you don’t have permission to access here"
            ], 404);
        }
    }

    //show personnal comment
    public function showHealthCommentSpecialist($emp_id, $grade, $class, $child_id, $healthdatasetname_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Specialist")
            ->first();
        if ($emp != null) {
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null) {
                $health_name = Healthdatasetname::find($healthdatasetname_id);
                if ($health_name != null) {
                    $pivot_namedata = $health_name->healthdatasetnameHealth->first()->pivot->where("healthdatasetname_id", $healthdatasetname_id)->get();
                    $healthData = Health::where("child_id", "=", $child_id)->where("id", $pivot_namedata->first()->health_id)->first();
                    if ($healthData != null) {
                        return response()->json([
                            "dis name"=>$health_name->dis_name,
                            "Data" => new PersonalCommentResource($healthData)
                        ], 200);
                    } else {
                        return response()->json([
                            "msg" => "has no health id"
                        ], 404);
                    }
                } else {
                    return response()->json([
                        "msg" => "has no health id"
                    ], 404);
                }
            } else {
                return response()->json([
                    "msg" => "child dosen't exist"
                ], 404);
            }
        } else {
            return response()->json([
                "msg" => "you don’t have permission to access here"
            ], 404);
        }
    }

    //show health data
    public function showHealthDataSpecialist($emp_id, $grade, $class, $child_id,$healthdatasetname_id){
        $emp = Employee::where("id",$emp_id)
        ->where("job_title", "Specialist")
        ->first();
        if ($emp != null) {
            $child = Child::where("id",$child_id)->where("grade", $grade)->where("class", $class)->first();
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

}
