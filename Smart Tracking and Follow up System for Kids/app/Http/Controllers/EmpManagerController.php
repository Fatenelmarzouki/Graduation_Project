<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityResource;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\ChildDataResource;
use App\Http\Resources\HealthDataOutResource;
use App\Http\Resources\HealthReportResource;
use App\Http\Resources\MidecalAnalysisResource;
use App\Http\Resources\PersonalCommentResource;
use App\Http\Resources\SubjectdatasetResource;
use App\Http\Resources\SubjectReportResource;
use App\Http\Resources\SubjectResource;
use App\Models\Activity;
use App\Models\Activitydataset;
use App\Models\Attendence;
use App\Models\Child;
use App\Models\Employee;
use App\Models\Food;
use App\Models\Health;
use App\Models\Healthdatasetname;
use App\Models\HealthReport;
use App\Models\Subject;
use App\Models\Subjectdataset;
use App\Models\SubjectReport;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class EmpManagerController extends Controller
{
    //show all children
    public function showAllChildManager($emp_id, $grade, $class){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
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
    public function showOneChildManager($emp_id, $grade, $class, $child_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
            ->first();
        if ($emp != null) {
            $child = Child::where('id',$child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null) {
                if ($child->image == null) {
                    $imagename = null;
                } else {
                    $imagename = asset("storage") . "/" . $child->image;
                }
                return response()->json([
                    "Child Name" => $child->name,
                    "Child Grade" => $child->grade,
                    "Child Class" => $child->class,
                    "Child Image" => $imagename,
                ],200);
            } else {
                return response()->json([
                    "msg" => "No Data Here"
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "Data Not Found"
            ],404);
        }
    }

    //show child profile
    public function showChildProfileManager($emp_id, $grade, $class, $child_id){
        $emp =Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
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
                ]);
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

    //show allowed food {DONE} "we need to make fun for show banded food" #22
    public function showSelectedFoodManager($emp_id, $grade, $class, $child_id){
        $emp =Employee::where("id", $emp_id)
        ->where("job_title", "Manager")
        ->first();
        if ($emp != null){
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null){
                $selected=$child->childSelectedfood;
                if ($child->image == null) {
                    $imagename = null;
                } else {
                    $imagename = asset("storage") . "/" . $child->image;
                }
                if ($selected != null) {
                    $arr1=[];
                    $arr2=[];
                    foreach($selected as $all){
                            $arr1[] = $all->selectedfoodFood->name;
                            $status_food = $all->count;
                            $arr2[] = $status_food;
                        }
                        // if(count($arr1)!=0 && count($arr2)!=0 ){
                            return response()->json([
                                "child Image" => $imagename,
                                "Child Name" => $child->name,
                                "Child Grade" => $child->grade,
                                "Child Class" => $child->class,
                                "food_name"=>$arr1,
                                "count"=>$arr2
                            ]);
                        // }else{
                        //     return response()->json([
                        //         "child Image" => $imagename,
                        //         "Child Name" => $child->name,
                        //         "Child Grade" => $child->grade,
                        //         "Child Class" => $child->class,
                        //         "food_name"=>null,
                        //         "count"=>null
                        //     ]);      
                        // }
                    }else{
                        return response()->json([
                            "msg" => "No Food Exist"
                        ],404);
                    }
            }else {
                    return response()->json([
                        "msg" => "child dosen't exist"
                    ],404);
                }
        }else {
                return response()->json([
                    "msg" => "you don’t have permission to access here"
                ], 404);
            }
    }

    //show banded food function {DONE} create or update in father cycle
    public function showBandedFoodManager($emp_id, $grade, $class, $child_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
            ->first();
        if ($emp != null) {
            $child = Child::where("id",$child_id)->where("grade", $grade)->where("class", $class)->first();
            $bandedfood_id = [];
            $food_name = [];
            if ($child != null) {
                foreach ($child->childBandedfood as $band) {
                    $bandedfood_id[] = $band->food_id;
                }
                foreach ($bandedfood_id as $b) {
                    $food_name[] = Food::select("id", "name")->where("id", $b)->first();
                }
                if ($food_name != null) {
                    return response()->json([
                        "Banded Food" => $food_name
                    ], 200);
                } else {
                    return response()->json([
                        "msg" => "This child has no banded food"
                    ], 404);
                }
            } else {
                return response()->json([
                    "msg" => "Child Doesn’t Exist"
                ], 404);
            }
        } else {
            return response()->json([
                "msg" => "you don’t have permission to access here"
            ], 404);
        }
    } 

    //show all health names 
    public function showHealthNameManager($emp_id, $grade, $class, $child_id){
        $emp = Employee::where("id",$emp_id)
        ->where("job_title", "Manager")
        ->first();
        if ($emp != null){
            $child = Child::where("id",$child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null) {
                $health = Health::where("child_id","=",$child_id)->get();
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
                    if(count($dis_id) != 0){
                        return response()->json([
                            "Child Data"=> new ChildDataResource($child),
                            "dis"=>$dis_id,
                            "count"=>count($dis_id)
                        ]);  
                    }else{
                        return response()->json([
                            "Child Data"=> new ChildDataResource($child),
                            "dis"=>null,
                            "count"=>count($dis_id)
                        ]); 
                    }
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

    //show health data
    public function showHealthDataManager($emp_id, $grade, $class, $child_id,$healthdatasetname_id){
        $emp = Employee::where("id",$emp_id)
        ->where("job_title", "Manager")
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

    //show medical analysis
    public function showHealthMedicalManager($emp_id, $grade, $class, $child_id, $healthdatasetname_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
            ->first();
        if ($emp != null) {
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null) {
                $health_name = Healthdatasetname::find($healthdatasetname_id);
                if ($health_name != null) {
                    $pivot_namedata = $health_name->healthdatasetnameHealth->first()->pivot->where("healthdatasetname_id", $healthdatasetname_id)->get();
                    $healthData = Health::where("child_id", "=", $child_id)->where("id", $pivot_namedata->first()->health_id)->first();
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

    //show the personnal comment 
    public function showHealthCommentManager($emp_id, $grade, $class, $child_id, $healthdatasetname_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
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

    //show the child record
    public function showChildRecordManager($emp_id, $grade, $class, $child_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
            ->first();
        if ($emp != null) {
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            $subjects = Subjectdataset::all();
            if ($child != null) {
                if ($child->image == null) {
                    $imagename = null;
                } else {
                    $imagename = asset("storage") . "/" . $child->image;
                }
                return response()->json([
                    "child_name" => $child->name,
                    "child_grade" => $child->grade,
                    "child Image" => $imagename,
                    "Child Activity" => $child->childActivitydataset->name,
                    "Activity ID"=>$child->childActivitydataset->id,
                    "Subjects" =>  SubjectdatasetResource::collection($subjects),
                ]);
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

    //show the subject data
    public function showSubjectDataManager($emp_id, $grade, $class, $child_id, $subjectdataset_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
            ->first();
            if ($emp != null) {
            $child = Child::where("id", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null) {
                $all = Attendence::where("child_id", $child_id)->where("attendence_status", "Absence")->get();
                $sub_name = Subjectdataset::select("name")->where("id", $subjectdataset_id)->first();
                $pivot_subjectdata = $child->subjectChild->first()->pivot->where("child_id", $child_id)->get();
                $sub_data = Subject::where("id", $pivot_subjectdata->first()->subject_id)->first();
                return response()->json([
                    "Subject Name" => $sub_name,
                    "Attendance" => AttendanceResource::collection($all),
                    "Subject Data" => new SubjectResource($sub_data)
                ]);
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

    //show all report
    public function showAllStudyReportManager($emp_id, $grade, $class, $child_id, $subjectdataset_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
            ->first();
        if ($emp != null) {
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null) {
                $reports = SubjectReport::where("child_id", "=", $child_id)->orderby('created_at', 'desc')->get();
                $sub_name = Subjectdataset::where("id", $subjectdataset_id)->first();
                if($sub_name != null){
                    if ($reports != null) {
                        return response()->json([
                            "All Report"=>SubjectReportResource::collection($reports)
                        ], 200);
                    } else {
                        return response()->json([
                            "msg" => "Reports Not Found"
                        ], 404);
                    }
                }else{
                    return response()->json([
                        "msg" => "Subject not found"
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

    //show one report 
    public function showOneStudyReportManager($emp_id, $grade, $class, $child_id, $subjectdataset_id, $report_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
            ->first();
            if ($emp != null) {
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null) {
                $report = SubjectReport::where("child_id", "=", $child->id)->where("id", "=", $report_id)->first();
                $sub_name = Subjectdataset::where("id", $subjectdataset_id)->first();
                if ($sub_name != null) {
                    if ($report != null) {
                        return response()->json([
                            'Report'=>new SubjectReportResource($report)
                        ], 200);
                    } else {
                        return response()->json([
                            'msg' => 'Report Not Found'
                        ], 404);
                    }
                } else {
                    return response()->json([
                        "msg" => "Subject Not Found"
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

    //show activity data
    public function showActivityDataManager($emp_id, $grade, $class, $child_id, $activitydataset_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
            ->first();
            if ($emp != null) {
            $child = Child::where("id", "=", $child_id)
            ->where("grade", $grade)
            ->where("class", $class)
            ->where("activitydataset_id",$activitydataset_id)
            ->first();
            if ($child != null) {
                $act_name = Activitydataset::select("name")->where("id", $activitydataset_id)->first();
                $act_data = Activity::where("child_id", $child_id)->first();
                if ($act_data != null) {
                    return response()->json([
                        "Activity Name" => $act_name,
                        "Activity Data" => new ActivityResource($act_data)
                    ]);
                } else {
                    return response()->json([
                        "msg" => "not vaild data now"
                    ], 404);
                }
            } else {
                return response()->json([
                    "msg" => "wrong activity"
                ], 404);
            }
        } else {
            return response()->json([
                "msg" => "you don’t have permission to access here"
            ], 404);
        }
    }

    //show all report
    public function showAllActivityReportManager($emp_id, $grade, $class, $child_id, $activitydataset_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
            ->first();
        if ($emp != null) {
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null) {
                $reports = SubjectReport::where("child_id", "=", $child_id)
                ->where("activitydataset_id",$activitydataset_id)
                ->orderby('created_at', 'desc')
                ->get();
                $act_name = Activitydataset::where("id", $activitydataset_id)->first();
                if($act_name != null){
                    if ($reports != null) {
                        return response()->json([
                            "All Report"=>SubjectReportResource::collection($reports)
                        ], 200);
                    } else {
                        return response()->json([
                            "msg" => "Reports Not Found"
                        ], 404);
                    }
                }else{
                    return response()->json([
                        "msg" => "Subject not found"
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

    //show one activity report
    public function showOneActivityReportManager($emp_id,$grade,$class,$child_id,$activitydataset_id,$report_id){
        $emp = Employee::where('id', '=', $emp_id)
            ->where('job_title', 'Manager')
            ->first();
        if ($emp != null) {
            $child = Child::where("grade", $grade)
            ->where("activitydataset_id", $activitydataset_id)
            ->where("class", $class)
            ->where("id", $child_id)
            ->first();
            if ($child != null) {
                $report = SubjectReport::where("child_id", "=", $child->id)
                ->where("activitydataset_id", $activitydataset_id)
                ->where("id", "=", $report_id)
                ->first();
                if ($report != null) {
                    return response()->json([
                        "Report"=>new SubjectReportResource($report)
                    ], 200);
                } else {
                    return response()->json([
                        'msg' => 'Report Not Found'
                    ], 404);
                }
            } else {
                return response()->json([
                    "msg" => "No Data For This Child"
                ], 404);
            }
        } else {
            return response()->json([
                "msg" => "Access Denied"
            ], 404);
        }
    }

    //show all health report -- new fun --
    public function showAllHealthReportManager($emp_id, $grade, $class, $child_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
            ->first();
        if ($emp != null) {
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null) {
                $reports = HealthReport::where("child_id", "=", $child_id)->orderby('created_at', 'desc')->get();
                    if (count($reports) != 0) {
                        return response()->json([
                            "All Report"=>HealthReportResource::collection($reports)
                        ], 200);
                    } else {
                            return response()->json([
                                "msg" => "Reports Not Found"
                            ], 404);
                        }
            } else {
                return response()->json([
                    "msg" => "child dosen't exist"
                ], 404);
            }
        }else {
            return response()->json([
                "msg" => "you don’t have permission to access here"
            ], 404);
        }
    }
    
    //show one health report -- new fun --
    public function showOneHealthReportManager($emp_id, $grade, $class, $child_id, $report_id){
        $emp = Employee::where("id", $emp_id)
            ->where("job_title", "Manager")
            ->first();
            if ($emp != null) {
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child != null) {
                $report = HealthReport::where("child_id", "=", $child->id)->where("id", "=", $report_id)->first();
                    if ($report != null) {
                        return response()->json([
                            'Report'=>new HealthReportResource($report)
                        ], 200);
                    } else {
                        return response()->json([
                            'msg' => 'Report Not Found'
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

}
