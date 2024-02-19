<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueRequest;
use App\Http\Resources\IssueResource;
use App\Models\Child;
use App\Models\Employee;
use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    //add issue
    public function addIssue($emp_id, $grade, $class, $child_id, IssueRequest $request){
        $emp = Employee::where("id","=",$emp_id)->where("job_title","=","Specialist")->first();
        if ($emp != null) {
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child == null) {
                return response()->json([
                    "msg" => "child not exist"
                ],404);
            } else {
                    $issue = Issue::create([
                        "name" => $request->name,
                        "problem" => $request->problem,
                        "from" => $request->from,
                        "reason" => $request->reason,
                        "take_action" => $request->take_action,
                        "emp_id" => $emp_id,
                        "child_id" => $child_id,
                    ]);
                    return response()->json([
                        "data" => new IssueResource($issue)
                    ],200);
                }
            }else {
            return response()->json([
                "msg" => "Access Denied"
            ],404);
        }
    }

    //show all issues
    public function showAllIssues($emp_id, $grade, $class, $child_id){
        $emp = Employee::where("id", "=", $emp_id)->where("job_title", "=", "Specialist")->first();
        if ($emp !=null) {
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if($child != null){
            $issues = Issue::where("child_id", "=", $child_id)->get();
                if (count($issues) != 0) {
                    return response()->json([
                        "msg" => IssueResource::collection($issues)
                    ],200);
                } else {
                    return response()->json([
                        "msg" => "No Issues Here"
                    ],404);
                }
            }else{
                return response()->json([
                    "msg" => "Child Not Exist"
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "You are Not Valid To Access Here "
            ],404);
        }
    }
}
