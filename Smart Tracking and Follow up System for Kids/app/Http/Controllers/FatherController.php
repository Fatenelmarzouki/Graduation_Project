<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordFatherRequest;
use App\Http\Requests\FatherRegisterRequest;
use App\Http\Requests\UpdateFatherProfileRequest;
use App\Models\Child;
use App\Models\Father;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\FatherResource;
use Illuminate\Support\Facades\Storage;


class FatherController extends Controller
{
    //father register {DONE} #1
    public function register(FatherRegisterRequest $request){
        if ($request->image != null) {
            $image_name = Storage::putFile("Father", $request->image);
        } elseif ($request->image == null) {
            $image_name = null;
        }
        $access_token = Str::random(64);
        $pass = bcrypt($request->password);
        // $user_name = $request->name." "."parent";
        $father = Father::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>$pass,
            "address"=>$request->address,
            "phone"=>$request->phone,
            "gender"=>$request->gender,
            "image"=>$image_name,
            "access_token"=>$access_token,
            "username"=>"parent ".$request->name,
            "admin_id"=>1,
        ]);
        return response()->json([
            "msg"=>"data inserted sucessfully",
            "data"=> new FatherResource($father),
        ],200);
    }
    //show profile {DONE} #8
    public function showFather($father_id){
            $father=Father::find($father_id);
            if($father != null){
                $child = Child::where("father_id","=",$father->id)->get();
                $child_name = [];
                $child_img = [];
                if($child!=null){
                    foreach ($child as $child_data) {
                        $child_name[] = $child_data->name;
                        $child_img[] = asset("storage")."/".$child_data->image;
                    }
                }else{
                    return response()->json([
                        "msg"=>"you haven't a child"
                    ],404);
                }
                return response()->json([
                    // "msg"=> new FatherResource($father),
                    "father_name" => $father->name,
                    "father_emil" => $father->email,
                    "father_image" =>asset("storage")."/".$father->image,
                    "father_phone" => $father->phone,
                    "father_address" => $father->address,
                    "child_name"=>$child_name,
                    "child_img"=>$child_img
                ]);
            }else{
                return response()->json([
                    "msg"=>"you don't have account, please sign up first"
                ],404);
            }
    }
    //update profile {DONE} #9
    public function editFather($father_id,UpdateFatherProfileRequest $request){
            //validation
            // in UpdateFatherProfileRequest class
            //check if it exists or not
            $edit = Father::find($father_id);
            if ($edit == null) {
                return response()->json([
                    'msg' => 'Father Not Found'
                ], 404);
            }
            if ($request->hasFile("image")) {
                //if we have image in the file but we don't have now so comment it
                if($edit->image!=null){
                    Storage::delete($edit->image);
                    $image_name = Storage::putFile("FatherImages", $request->image); //rename - uploads
                }
                elseif($edit->image==null){
                    $image_name = Storage::putFile("FatherImages", $request->image); //rename - uploads
                }
            }
            elseif ($request->image == null) {
                $image_name = $edit->image;
            }
            $edit->update([
                "name" => $request->name,
                "email" => $request->email,
                "address" => $request->address,
                "phone" => $request->phone,
                "image" => $image_name,
            ]);
            return response()->json([
                'msg' => 'Father Updated Successfully',
                'new Data' => new FatherResource($edit)
            ], 201);
    }
    //change password {DONE} #10
    public function editFatherPassword($father_id,ChangePasswordFatherRequest $request){
            //check if it exists or not
            $edit = Father::find($father_id);
            if($edit!=null){
                $passcheck = Hash::check($request->current_password,$edit->password);
                // $passcheck = $edit->password;
                if($passcheck){
                    $edit->update([
                        "password" =>bcrypt($request->password)
                    ]);
                    return response()->json([
                        'msg' => 'Password Updated Successfully',
                        'new Data' => new FatherResource($edit)
                    ], 200);
                }else{
                    return response()->json([
                        'msg' => 'wrong password'
                    ], 404);
                }
            }else{
                return response()->json([
                    'msg' =>"you don't have account, please sign up first"
                ], 404);
            }
    }
    
}