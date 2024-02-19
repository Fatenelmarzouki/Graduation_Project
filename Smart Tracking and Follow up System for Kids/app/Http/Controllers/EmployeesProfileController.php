<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordFatherRequest;
use App\Http\Requests\UpdateEmpProfileRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeesProfileController extends Controller
{
    //to show employee profile {DONE}
    public function ShowProfile($emp_id){
        $data = Employee::find($emp_id);
        if($data!=null){
            return response()->json([
                "data"=> new EmployeeResource($data)
            ],200);
        }else{
            return response()->json([
                "msg"=> "data not found"
            ],404);
        }
    }

    //to update employee profile {DONE}
    public function UpdateProfile($emp_id,UpdateEmpProfileRequest $request){
        $data = Employee::find($emp_id);
        if($data!=null){
            if($request->image!=null){
                if($data->image != null){
                    Storage::delete($data->image);
                    $image_name = Storage::putFile("Emp Images",$request->image);
                }elseif($data->image == null){
                    $image_name = Storage::putFile("Emp Images",$request->image);
                }
            }elseif ($request->image==null) {
                $image_name = null;
            }
            $data->Update([
                "name"=>$request->name,
                "phone"=>$request->phone,
                "address"=>$request->address,
                "image"=>$image_name
            ]);
            return response()->json([
                "data"=> new EmployeeResource($data)
            ],200);
        }else{
            return response()->json([
                "msg"=>"not here",
            ],404);
        }

    }

    //change password
    public function editEmpPassword($emp_id, ChangePasswordFatherRequest $request){
        //check if it exists or not
        $edit = Employee::find($emp_id);
        if ($edit != null) {
            $passcheck = Hash::check($request->current_password, $edit->password);
            if ($passcheck) {
                $edit->update([
                    "password" => bcrypt($request->password)
                ]);
                return response()->json([
                    'msg' => 'Password Updated Successfully',
                    'new Data' => new EmployeeResource($edit)
                ], 200);
            } else {
                return response()->json([
                    'msg' => 'wrong password'
                ], 404);
            }
        } else {
            return response()->json([
                'msg' => "you don't have account, please sign up first"
            ], 404);
        }
    }
}
