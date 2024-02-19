<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddReportRequest;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\ChildDataResource;
use App\Http\Resources\SubjectReportResource;
use App\Http\Resources\SubjectResource;
use App\Models\Activity;
use App\Models\Activitydataset;
use App\Models\Attendence;
use App\Models\Child;
use App\Models\Employee;
use App\Models\Subject;
use App\Models\Subjectdataset;
use App\Models\SubjectReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmpTeacherController extends Controller
{
    //show all child {DONE}
    public function showAllChildTeacher($emp_id,$subjectdataset_id,$grade,$class){
        $emp = Employee::where("id",$emp_id)
        ->where("job_title","Teacher")
        ->where("subjectdataset_id",$subjectdataset_id)
        ->first();
        if($emp !=null){
                $childs = Child::where("grade",$grade)->where("class",$class)->get();
                if (count($childs)!=0) {
                    return response()->json([
                        'all children' => ChildDataResource::collection($childs),
                    ],200);
                } else {
                    return response()->json([
                        "msg" => "No Data Here"
                    ],404);
                }
            }else{
            return response()->json([
                "msg" => "access denied"
            ],404);
        }
    }

    //show all child has activity {Done}
    public function showAllChildActivity($emp_id,$activitydataset_id,$grade,$class){
        $emp = Employee::where("id",$emp_id)->where("job_title","Teacher")->where("activitydataset_id",$activitydataset_id)->first();
        if($emp !=null){
            $childs = Child::where("activitydataset_id",$activitydataset_id)->where("grade",$grade)->where("class",$class)->get();
            if (count($childs)!= 0) {
                return response()->json([
                    'all children' => ChildDataResource::collection($childs),
                ]);
            } else {
                return response()->json([
                    "msg" => "No Children Register This Activity"
                ]);
            }
        }else{
            return response()->json([
                "msg" => "access denied"
            ]);
        }
    }

    //insert subject data {DONE}
    public function insertSubjectData($emp_id,$subjectdataset_id,$grade,$class,$child_id,Request $request){
        $emp = Employee::where("id",$emp_id)->where("job_title","Teacher")->where("subjectdataset_id",$subjectdataset_id)->first();
        $sub_name = Subjectdataset::select("name")->where("id",$subjectdataset_id)->first();
        if($emp!=null){
            $va = Validator::make($request->all(),[
                "mark"=>"required|numeric|max:100",
                "behavior"=>["required",Rule::in(['Turbulent', 'Conformist', 'Solitary', 'Friendly'])],
                "activity"=>["required",Rule::in(['Excellent', 'Very Good', 'Good', 'Acceptable'])],
                "interact"=>["required",Rule::in(['Excellent', 'Very Good', 'Good', 'Acceptable'])],
                "team_work"=>["required",Rule::in(['Excellent', 'Very Good', 'Good', 'Acceptable'])],
            ]);
            if($va->fails()){
                return response()->json([
                    "msg"=>$va->errors()
                ],404);
            }else{
                $child= Child::where("grade",$grade)->where("class",$class)->where("id",$child_id)->first();
                if($child != null){
                    $sub=Subject::updateOrCreate(["child_id"=>$child->id ,"subjectdataset_id"=>$subjectdataset_id ],[
                        "mark"=>$request->mark,
                        "behavior"=>$request->behavior,
                        "activity"=>$request->activity,
                        "interact"=>$request->interact,
                        "team_work"=>$request->team_work,
                        "father_id"=>$child->father_id,
                        "subjectdataset_id"=>$subjectdataset_id,
                        "child_id"=>$child->id 
                    ]);
                    // $sub->childSubject()->syncWithoutDetaching($child->id);
                    return response()->json([
                        // "sub name"=>$sub_name ,
                        "msg"=> new SubjectResource($sub),
                    ],200);
                }else{
                    return response()->json([
                        "msg"=>"child dosen't exist"
                    ],200);
                }
            }
        }else{
            return response()->json([
                "msg"=>"access dened"
            ],404);
        }
    }
    
    //insert activity {Done}
    public function insertActivityData($emp_id,$activitydataset_id,$grade,$class,$child_id,Request $request){
        $emp = Employee::where("id",$emp_id)->where("job_title","Teacher")->where("activitydataset_id",$activitydataset_id)->first();
        $act_name = Activitydataset::select("name")->where("id",$activitydataset_id)->first();
        if($emp!=null){
            $va = Validator::make($request->all(),[
                "mark"=>"required|numeric|max:100",
                "behavior"=>["required",Rule::in(['Turbulent', 'Conformist', 'Solitary', 'Friendly'])],
                "team_work"=>["required",Rule::in(['Excellent', 'Very Good', 'Good', 'Acceptable'])],
                "performance_evaluation"=>["required",Rule::in(['Excellent', 'Very Good', 'Good', 'Acceptable'])],
            ]);
            if($va->fails()){
                return response()->json([
                    "msg"=>$va->errors()
                ],404);
            }else{
                $child= Child::where("activitydataset_id",$activitydataset_id)
                ->where("grade",$grade)
                ->where("class",$class)
                ->where("id",$child_id)
                ->first();
                if($child!=null){
                    $act = Activity::updateOrCreate(["child_id"=>$child->id ],[
                        "mark"=>$request->mark,
                        "behavior"=>$request->behavior,
                        "team_work"=>$request->team_work,
                        "performance_evaluation"=>$request->performance_evaluation,
                        "child_id"=>$child->id 
                    ]);
                    return response()->json([
                        "msg"=> new ActivityResource($act),
                        // "sub name"=>$act_name,
                    ],200);
                }else{
                    return response()->json([
                        "msg"=>"wrong activity access"
                    ],404);
                }
            }
        }else{
            return response()->json([
                "msg"=>"access dened"
            ],404);
        }
    }
    
    //show attendance{Done}
    public function showAttendanceEmp($emp_id,$subjectdataset_id,$grade,$class,$child_id){
        $emp = Employee::where("id",$emp_id)->where("job_title","Teacher")->where("subjectdataset_id",$subjectdataset_id)->first();
        // $sub_name = Subjectdataset::select("name")->where("id",$subjectdataset_id)->first();
        if($emp!=null){
            $child= Child::where("grade",$grade)->where("class",$class)->where("id",$child_id)->first();
            if($child!=null){
                $all = Attendence::where("child_id",$child_id)->where("attendence_status","Absence")->get();
                return response()->json([
                    "msg"=> AttendanceResource::collection($all)
                ]);
            }else{
                return response()->json([
                    "msg"=>"child dosen't exist"
                ],404);
            }
        }else{
            return response()->json([
                "msg"=>"access dened"
            ],404);
        }        
    }

    //insert attendance {DONE}
    public function insertAttendance($emp_id,$subjectdataset_id,$grade,$class,$child_id,Request $request){
        $emp = Employee::where("id",$emp_id)->where("job_title","Teacher")->where("subjectdataset_id",$subjectdataset_id)->first();
        if($emp!=null){
            $va = Validator::make($request->all(),[
                "attendance_date"=>"required|date_format:Y-m-d",
                "attendance_status"=>["required",Rule::in(["Absence","Presence"])],
            ]);
            if($va->fails()){
                return response()->json([
                    "msg"=>$va->errors()
                ],404);
            }else{
                $child= Child::where("grade",$grade)->where("class",$class)->where("id",$child_id)->first();
                if($child != null){
                    $att=Attendence::UpdateorCreate([
                        "attendence_date"=>$request->attendance_date,
                        "attendence_status"=>$request->attendance_status,
                        "child_id"=>$child_id,
                        "emp_id"=>$emp_id
                    ]);
                    return response()->json([
                        "msg"=> new AttendanceResource($att)
                    ],200);
                }else{
                    return response()->json([
                        "msg"=>"child dosen't exist"
                    ],404);
                }
            }
        }else{
            return response()->json([
                "msg"=>"access dened"
            ],404);
        }
    }

    //show all study reports for emp{DONE}
    public function showAllStudyTeacher($emp_id,$subjectdataset_id,$grade,$class,$child_id){
        $emp = Employee::where("id",$emp_id)
        ->where('job_title', 'Teacher')
        ->where("subjectdataset_id", $subjectdataset_id)
        ->first();
        if ($emp != null){
            $child= Child::where("grade",$grade)->where("class",$class)->where("id",$child_id)->first();
            if ($child != null) {
                $reports = SubjectReport::where("child_id","=",$child_id)->orderby("created_at","desc")->get();
                if($reports!=null){
                    return response()->json([
                        "msg"=>SubjectReportResource::collection($reports),
                    ],200);
                }else{
                    return response()->json([
                        "msg"=>"no reports found"
                    ],404);
                }
            } else {
                return response()->json([
                    "msg" => "no data for this child"
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "access dened"
            ],404);
        }
    }

    //show all activity reports for emp{DONE}
    public function showAllActivityTeacher($emp_id,$activitydataset_id,$grade,$class,$child_id){
        $emp = Employee::where("id",$emp_id)
        ->where('job_title', 'Teacher')
        ->where("activitydataset_id",$activitydataset_id)
        ->first();
        if ($emp != null){
            $child= Child::where("grade",$grade)
            ->where("class",$class)
            ->where("id",$child_id)
            ->where("activitydataset_id",$activitydataset_id)
            ->first();
            if ($child != null) {
                $reports = SubjectReport::where("child_id",$child_id)->where("emp_id",$emp_id)->orderby("created_at","desc")->get();
                if($reports!=null){
                    return response()->json([
                        "msg"=>SubjectReportResource::collection($reports),
                    ],200);
                }else{
                    return response()->json([
                        "msg"=>"no reports found"
                    ],404);
                }
            } else {
                return response()->json([
                    "msg" => "no data for this child"
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "access dened"
            ],404);
        }
    }

    //show one study report
    public function showOneStudyTeacher($emp_id, $subjectdataset_id, $grade, $class, $child_id, $report_id){
        $emp = Employee::where('id', '=', $emp_id)
            ->where('job_title', 'Teacher')
            ->where("subjectdataset_id", $subjectdataset_id)
            ->first();
        if ($emp != null) {
            $child = Child::where("grade", $grade)->where("class", $class)->where("id", $child_id)->first();
            if ($child != null) {
                $report = SubjectReport::where("child_id", "=", $child->id)->where("id", "=", $report_id)->first();
                if ($report != null) {
                    return response()->json([
                        new SubjectReportResource($report)
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

    //show one activity report
    public function showOneActivityTeacher($emp_id, $activitydataset_id, $grade, $class, $child_id, $report_id){
        $emp = Employee::where('id', '=', $emp_id)
            ->where('job_title', 'Teacher')
            ->where("activitydataset_id", $activitydataset_id)
            ->first();
        if ($emp != null) {
            $child = Child::where("grade", $grade)
            ->where("activitydataset_id", $activitydataset_id)
            ->where("class", $class)
            ->where("id", $child_id)
            ->first();
            if ($child != null) {
                $report = SubjectReport::where("child_id", "=", $child->id)
                ->where("emp_id",$emp_id)
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

    //insert subject report
    public function addStudyReportTeacher( $emp_id, $subjectdataset_id, $grade, $class, $child_id,AddReportRequest $request){
        $emp = Employee::where('id', '=', $emp_id)
            ->where('job_title', 'Teacher')
            ->where("subjectdataset_id", $subjectdataset_id)
            ->first();
        if ($emp != null) {
            $child_data =Child::where("grade", $grade)->where("class", $class)->where("id", $child_id)->first();;
            if ($child_data != null) {
                $study_report = SubjectReport::create([
                    "report" => $request->report,
                    "child_id" => $child_id,
                    "father_id" => $child_data->father_id,
                    "emp_id" => $emp_id
                ]);
                return response()->json([
                    "data" => new SubjectReportResource($study_report)
                ], 200);
            }else{
                return response()->json([
                    "msg" => "child not exist"
                ], 404);
            }
        }else {
            return response()->json([
                "msg" => "Access Denied"
            ]);
        }
    }

    //insert activity report
    public function addActivityReportTeacher( $emp_id, $activitydataset_id, $grade, $class, $child_id,AddReportRequest $request){
        $emp = Employee::where('id', '=', $emp_id)
            ->where('job_title', 'Teacher')
            ->where("activitydataset_id", $activitydataset_id)
            ->first();
        if ($emp != null) {
            $child_data =Child::where("grade", $grade)
            ->where("class", $class)
            ->where("activitydataset_id", $activitydataset_id)
            ->where("id", $child_id)
            ->first();
            if ($child_data != null) {
                $study_report = SubjectReport::create([
                    "report" => $request->report,
                    "child_id" => $child_id,
                    "father_id" => $child_data->father_id,
                    "emp_id" => $emp_id
                ]);
                return response()->json([
                    "data" => new SubjectReportResource($study_report)
                ], 200);
            }else{
                return response()->json([
                    "msg" => "child not exist"
                ], 404);
            }
        }else {
            return response()->json([
                "msg" => "Access Denied"
            ]);
        }
    }

    //show activity name
    public function showActivityName($emp_id,$activitydataset_id,$grade,$class,$child_id){
        $emp = Employee::where("id",$emp_id)->where("job_title","Teacher")->where("activitydataset_id",$activitydataset_id)->first();
        $act_name = Activitydataset::select("name")->where("id",$activitydataset_id)->first();
        if($emp!=null){
                $child= Child::where("activitydataset_id",$activitydataset_id)
                ->where("grade",$grade)
                ->where("class",$class)
                ->where("id",$child_id)
                ->first();
                if($child!=null){
                    return response()->json([
                        "Activity Name"=>$act_name,
                    ],200);
                }else{
                    return response()->json([
                        "msg"=>"wrong activity access"
                    ],404);
                }
        }else{
            return response()->json([
                "msg"=>"access dened"
            ],404);
        }
    }

    //show subject name
    public function showSubjectName($emp_id,$subjectdataset_id,$grade,$class,$child_id){
        $emp = Employee::where("id",$emp_id)->where("job_title","Teacher")->where("subjectdataset_id",$subjectdataset_id)->first();
        $sub_name = Subjectdataset::select("name")->where("id",$subjectdataset_id)->first();
        if($emp!=null){
                $child= Child::where("grade",$grade)->where("class",$class)->where("id",$child_id)->first();
                if($child != null){
                    // $sub->childSubject()->syncWithoutDetaching($child->id);
                    return response()->json([
                        "Subject Name"=>$sub_name,
                    ],200);
                }else{
                    return response()->json([
                        "msg"=>"child dosen't exist"
                    ],200);
                }
        }else{
            return response()->json([
                "msg"=>"access dened"
            ],404);
        }
    }
}
