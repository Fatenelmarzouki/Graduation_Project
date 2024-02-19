<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRepalyRequest;
use App\Http\Requests\PostRequest;
use App\Http\Resources\IssueResource;
use App\Http\Resources\PostNameResource;
use App\Http\Resources\PostResource;
use App\Models\Child;
use App\Models\Employee;
use App\Models\Father;
use App\Models\Issue;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //add post function {DONE}
    public function addPost($emp_id, $grade, $class, $child_id, PostRequest $request){
        $emp = Employee::where("id", "=", $emp_id)->where("job_title", "=", "Specialist")->first();
        if ($emp != null) {
            $child = Child::where("id", "=", $child_id)->where("grade", $grade)->where("class", $class)->first();
            if ($child == null) {
                return response()->json([
                    "msg" => "child not exist"
                ],404);
            }else{
                $post = Post::create([
                        "name" => $request->name,
                        "problem" => $request->problem,
                        "take_action" => $request->take_action,
                        "requirements" => $request->requirements,
                        "emp_id" => $emp_id,
                        "child_id" => $child_id,
                        "father_id" => $child->father_id
                    ]);
                return response()->json([
                    "data" => new PostResource($post)
                ],200);
            }
        }else {
            return response()->json([
                "msg" => "Access denied"
            ],404);
        }
    }

    //show all post to father by father_id,child_id(collection=>PostResource) {DONE}
    public function showAllPost($father_id, $child_id){
        $father = Father::find($father_id);
        if ($father != null) {
            $child = Child::where("father_id","=",$father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                $posts = Post::where("child_id", "=", $child_id)->get();
                if (count($posts) != 0) {
                    return response()->json([
                        "data"=>PostNameResource::collection($posts)
                    ],200); 
                } else {
                    return response()->json([
                        "msg" => "Posts Not Found"
                    ],404);
                }
            } else {
                return response()->json([
                    "msg" => "You must register data for your Child "
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "You Don’t Have Account,Please Sign up First"
            ],404);
        }
    }

    //show one post {DONE}
    public function showOnePost($father_id,$child_id,$post_id){
        $father = Father::find($father_id);
        if ($father != null) {
            $child = Child::where("father_id", "=", $father->id)->where("id", "=", $child_id)->first();
            if ($child != null) {
                $post = Post::where("child_id", "=", $child_id)->where("id","=",$post_id)->first();
                if ($post != null) {
                    return response()->json([
                       "data"=> new PostResource($post)
                    ],200); 
                } else {
                    return response()->json([
                        "msg" => "Posts Not Found"
                    ],404);
                }
            } else {
                return response()->json([
                    "msg" => "You must register data for your Child "
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "You Don’t Have Account,Please Sign up First"
            ],404);
        }
    }

    //father add replay {DONE}
    public function addReplay($father_id,$child_id,$post_id,AddRepalyRequest $request){
        $father = Father::find($father_id);
        if ($father != null) {
            $child = Child::where("father_id", "=", $father->id)->where("id", "=", $child_id)->first();
            if ($child != null) {
                $post = Post::where("child_id", "=", $child_id)->where("id","=",$post_id)->first();
                if ($post != null) {
                    $post->update([
                        "father_reply"=>$request->replay
                    ]);
                    return response()->json([
                        "s" => "updated",
                        "msg" => new PostResource($post)
                    ],200);
                } else {
                    return response()->json([
                        "msg" => "Posts Not Found"
                    ],404);
                }
            } else {
                return response()->json([
                    "msg" => "You must register data for your Child "
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "You Don’t Have Account,Please Sign up First"
            ],404);
        }
    }


}
