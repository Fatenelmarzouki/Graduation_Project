<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddReportRequest;
use App\Http\Resources\HealthReportResource;
use App\Http\Resources\SubjectReportResource;
use App\Models\Activitydataset;
use App\Models\Child;
use App\Models\Employee;
use App\Models\Father;
use App\Models\HealthReport;
use App\Models\SubjectReport;

class ReportController extends Controller
{
    //show all study reports for father{DONE} --adding the subjectdataset_id--
    public function showAllStudy($father_id,$child_id,$subjectdataset_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                $reports = SubjectReport::where("child_id","=",$child_id)->where("subjectdataset_id",$subjectdataset_id)->orderby("created_at","desc")->get();
                if($reports!=null){
                    return SubjectReportResource::collection($reports);
                }else{
                    return response()->json([
                        "msg"=>"no reports found"
                    ],404);
                }
            } else {
                return response()->json([
                    "msg" => "you must register data for your child"
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "you don't have account, please sign up first"
            ],404);
        }
    }

    //show all health reports for father {DONE}
    public function showAllHealth($father_id, $child_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                $reports = HealthReport::where("child_id","=",$child_id)->orderby("created_at","desc")->get();
                if($reports!=null){
                    return HealthReportResource::collection($reports);
                }else{
                    return response()->json([
                        "msg"=>"no reports found"
                    ],404);
                }
            } else {
                return response()->json([
                    "msg" => "you must register data for your child"
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "you don't have account, please sign up first"
            ],404);
        }
    }

    //show all study reports for emp{DONE}
    public function showAllStudyEmp($emp_id,$subjectdataset_id,$grade,$class,$child_id){
        $emp = Employee::where("id",$emp_id)
        ->where("job_title" ,"!=" , "Doctor")
        ->where("job_title" ,"!=" , "Seller")
        ->where('job_title', '!=', 'Specialist')
        ->where("subjectdataset_id",$subjectdataset_id)
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

    //show all health reports for doctor {DONE}
    public function showAllHealthEmp($emp_id, $child_id){
        $emp = Employee::where("id",$emp_id)->where("job_title" ,"!=" , "Seller")
        ->where("job_title" ,"!=" , "Teacher") //Doctor
        ->where('job_title', '!=', 'Specialist')
        ->first();
        if ($emp != null){
            $child = Child::find($child_id);
            if ($child != null) {
                $reports = HealthReport::where("child_id","=",$child_id)->orderby("created_at","desc")->get();
                if($reports!=null){
                    return HealthReportResource::collection($reports);
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
        }else{
            return response()->json([
                "msg" => "access dened"
            ],404);
        }
    }

    //Subject Report father {Done} --adding the subjectdataset_id--
    public function showOneStudy($father_id,$child_id,$subjectdataset_id,$report_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                $report = SubjectReport::where("child_id", "=", $child->id)->where("subjectdataset_id",$subjectdataset_id)->where("id","=",$report_id)->first();
                if ($report != null) {
                    return new SubjectReportResource($report);
                }else{
                    return response()->json([
                        'msg' => 'Report Not Found'
                    ], 404);
                }
            } else {
                return response()->json([
                    "msg" => "you must register data for your child"
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "you don't have account, please sign up first"
            ],404);
        }
    }

    //show one study report for emp
    public function showOneStudyEmp($emp_id,$subjectdataset_id,$grade,$class,$child_id, $report_id){
        $emp = Employee::where('id', '=', $emp_id)
        ->where('job_title', '<>', 'Doctor')
        ->where('job_title', '<>', 'Specialist')
        ->where('job_title', '<>', 'Seller')
        ->where("subjectdataset_id",$subjectdataset_id)
        ->first();
        if ($emp != null) {
            $child= Child::where("grade",$grade)->where("class",$class)->where("id",$child_id)->first();
            if ($child != null) {
                $report = SubjectReport::where("child_id", "=", $child->id)->where("id", "=", $report_id)->first();
                if ($report != null) {
                    return response()->json([
                        new SubjectReportResource($report)
                    ],200); 
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

    //show one health report for emp
    public function showOneHealthEmp($emp_id, $child_id, $report_id){
        $emp = Employee::where('id', '=', $emp_id)->where('job_title', '<>', 'Teacher')->where('job_title', '<>', 'Specialist')->where('job_title', '<>', 'Seller')->first();
        if ($emp != null) {
            $child = Child::find($child_id);
            if ($child != null) {
                $report = HealthReport::where("child_id", "=", $child->id)->where("id", "=", $report_id)->first();
                if ($report != null){
                    return new HealthReportResource($report);
                }else{
                    return response()->json([
                        'msg' => 'Report Not Found'
                    ],404);
                }
            }else{
                return response()->json([
                    "msg" => "No Data For This Child"
                ],404);
            }
        }else{
            return response()->json([
                "msg" => "Access Denied"
            ],404);
        }
    }

    //Health Report father {DONE}
    public function showOneHealth($father_id,$child_id,$report_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                $report = HealthReport::where("child_id", "=", $child->id)->where("id","=",$report_id)->first();
                if ($report != null) {
                    return new HealthReportResource($report);
                }else{
                    return response()->json([
                        'msg' => 'Report Not Found'
                    ], 404);
                }
            } else {
                return response()->json([
                    "msg" => "you must register data for your child"
                ], 404);
            }
        } else {
            return response()->json([
                "msg" => "you don't have account, please sign up first"
            ], 404);
        }
    }

    //show all activity reports for father -- new fun --
    public function showAllActivity($father_id, $child_id, $activitydataset_id){
        $father = Father::find($father_id);
        if ($father != null) {
            $child = Child::where("father_id", "=", $father->id)
            ->where("id", "=", $child_id)
            ->where('activitydataset_id','=',$activitydataset_id)->first();
            if ($child != null) {
                $reports = SubjectReport::where("child_id", $child_id)->where('activitydataset_id', '=', $activitydataset_id)->orderby("created_at", "desc")->get();
                if ($reports != null) {
                    return response()->json([
                        "msg" => SubjectReportResource::collection($reports),
                    ], 200);
                } else {
                    return response()->json([
                        "msg" => "no reports found"
                    ], 404);
                }
            } else {
                return response()->json([
                    "msg" => "you must register data for your child"
                ], 404);
            }
        } else {
            return response()->json([
                "msg" => "you don't have account, please sign up first"
            ], 404);
        }
    }

    //show one activity report for father -- new fun --
    public function showOneActivity($father_id,$child_id, $activitydataset_id,$report_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)
            ->where('activitydataset_id', '=', $activitydataset_id)
            ->where("id","=",$child_id)->first();
            if ($child != null) {
                $report = SubjectReport::where("child_id", "=", $child->id)
                ->where('activitydataset_id', '=', $activitydataset_id)
                ->where("id","=",$report_id)->first();
                if ($report != null) {
                    return new SubjectReportResource($report);
                }else{
                    return response()->json([
                        'msg' => 'Report Not Found'
                    ], 404);
                }
            } else {
                return response()->json([
                    "msg" => "you must register data for your child"
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "you don't have account, please sign up first"
            ],404);
        }
    }

    //insert Report {DONE}
    public function addReport($child_id,$emp_id,AddReportRequest $request){
        $emp_data = Employee::find($emp_id);
        if($emp_data!=null){
            $child_data = Child::find($child_id);
            if($child_data==null){
                return response()->json([
                    "msg"=>"child not exist"
                ],404);
            }
            if($emp_data->job_title == "Teacher" ){
                $study_report=SubjectReport::create([
                    "report"=>$request->report,
                    "child_id"=>$child_id,
                    "father_id"=>$child_data->father_id,
                    "emp_id"=>$emp_id
                ]);
                return response()->json([
                    "msg"=> "data inserted successfully",
                    "data"=> new SubjectReportResource($study_report)
                ],200);
            }elseif($emp_data->job_title == "Doctor" ){
                $health_report=HealthReport::create([
                    "report"=>$request->report,
                    "child_id"=>$child_id,
                    "father_id"=>$child_data->father_id,
                    "emp_id"=>$emp_id
                ]);
                return response()->json([ 
                    "msg"=> "data inserted successfully",
                    "data"=> new HealthReportResource($health_report)
                ],200);
            }else{
                return response()->json([
                    "msg"=>"you don't have the rights to write report"
                ],404);
            }
        }else{
            return response()->json([
                "msg"=>"employee dosen't exist"
            ]);
        }
    }

    public function pop(){
        $activitydataset_id = Activitydataset::select("id")->get();
        return response()->json([ 
            "data"=> $activitydataset_id
        ],200);
    }
    
}
