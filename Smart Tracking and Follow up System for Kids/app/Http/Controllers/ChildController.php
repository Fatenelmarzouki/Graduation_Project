<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Child;
use App\Models\Father;
use App\Models\Health;
use App\Models\Subject;
use App\Models\Activity;
use App\Models\Employee;
use App\Models\AddHealth;
use App\Models\Attendence;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Subjectdataset;
use App\Models\Activitydataset;
use Illuminate\Validation\Rule;
use App\Models\Healthdatasetname;
use App\Models\Healthdatasettype;
use App\Http\Resources\ChildResource;
use App\Http\Resources\HealthResource;
use App\Http\Resources\SubjectResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\AddHealthResource;
use App\Http\Resources\ChildDataResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AttendanceResource;
use App\Http\Requests\ChildRegisterRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\InsertNewHealthRequest;
use App\Http\Resources\SubjectdatasetResource;
use App\Http\Resources\ActivityDataSetResource;
use App\Http\Resources\HealthDataOutResource;
use App\Http\Resources\MidecalAnalysisResource;
use App\Http\Resources\PersonalCommentResource;
use App\Http\Resources\QrcodeResource;

class ChildController extends Controller
{
    //show all activity for father {Done} #3
    public function showAllActivity(){
        $all=Activitydataset::all();
        if($all!=null){
            return ActivityDataSetResource::collection($all);
        }else{
            return response()->json([
                "msg"=>"no activity here"
            ],404);
        }
    }

    //register child {Done} #4, qr & code
    public function RegisterChild($father_id,ChildRegisterRequest $request){
        if($request->image != null){
            $image_name=Storage::putFile("childImages",$request->image);
        }else{
            $image_name=null;
        }
        $child_code = Str::random(6);
        $random_string = Str::random(10);
        $qr_text = $request->name . $random_string;
        $qr_name = Str::random(25).".png";
        $qr=QrCode::format('png')->style('round')->size(200)->generate($qr_text);
        $q=Storage::disk('public')->put('QrCodes/'.$qr_name, $qr);
        $child = Child::create([
            "name"=>$request->name,
            "age"=>$request->age,
            "grade"=>$request->grade,
            "gender"=>$request->gender,
            "weight"=> $request->weight,
            "height"=>$request->height,
            "blood"=>$request->blood,
            "health_condition"=>$request->health_condition,
            "image"=>$image_name,
            "father_id"=>$father_id,
            "activitydataset_id"=>$request->activitydataset_id, //activity
            "qr_code"=>$qr_name,
            "child_code"=>$child_code,
            "qr_string"=>$qr_text
        ]);

        return response()->json([
            "msg"=>"data inserted sucessfully",
            "data"=> new ChildResource($child),
        ],200);
    }

    //show health name and type  {DONE}  #5
    public function showHealthNameType($father_id,$child_id,$healthdatasetname_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                $health_name = Healthdatasetname::find($healthdatasetname_id);
                if($health_name!=null){
                    $health_type = Healthdatasettype::where("healthdatasetname_id","=",$healthdatasetname_id)->get();
                    if($health_type!=null){
                        $alltypes=[];
                        foreach ($health_type as $type) {
                            $alltypes[]=$type->dis_type;
                        }
                        return response()->json([
                            "dis_name"=> $health_name->dis_name,
                            "dis_type"=> $alltypes,
                        ],200);
                    }else{
                        return response()->json([
                            "dis_name"=> "health has no type"
                        ],404);
                    }
                }else{
                    return response()->json([
                        "dis_name"=> "health not found"
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

    // to show health name and type to take father selection {DONE} #6
    public function showHealthGetFather($father_id,$child_id,$healthdatasetname_id, Request $request){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                $health_name = Healthdatasetname::find($healthdatasetname_id);
                if($health_name!=null){
                    $health_type = Healthdatasettype::where("healthdatasetname_id","=",$healthdatasetname_id)->get();
                    if($health_type!=null){
                        $alltypes=[];
                        foreach ($health_type as $type) {
                            $alltypes[]=$type->dis_type;
                        }
                        $va = Validator::make($request->all(),[
                            "dis_type"=>["required",Rule::in($alltypes)],
                            "medicien"=>"string|max:100",
                            "medical_analysis"=>"file|nullable|mimes:jpg,png,jpeg,gif,webP",
                            "personal_comment"=>"string|max:100",
                            "banded_food"=>"string|max:100"
                        ]);
                        if($va->fails()){
                            return response()->json([
                                "msg"=>$va->errors()
                            ],404);
                        }else{
                            if($request->medical_analysis != null){
                                $image_name=Storage::putFile("MedicalAnalysis",$request->medical_analysis);
                            }else{
                                $image_name=null;
                            }
                            $healthData = Health::create([
                                'medicien'=>$request->medicien,
                                'medical_analysis'=>$image_name,
                                'personal_comment'=>$request->personal_comment,
                                'father_id'=>$father_id,
                                'child_id'=>$child_id,
                                "banded_food"=>$request->banded_food
                            ]);
                            $healthData->healthHealthdatasetname()->syncWithoutDetaching($health_name->id);
                            $inserted_type = Healthdatasettype::where("dis_type","=",$request->dis_type)->first();
                            $healthData->healthHealthdatasettype()->syncWithoutDetaching($inserted_type->id);
                            return response()->json([
                                "msg" => "inserted",
                                "data" => new HealthResource($healthData)
                            ]);
                        }
                    }else{
                        return response()->json([
                            "dis_name"=> "health has no type"
                        ],404);
                    }
                }else{
                    return response()->json([
                        "dis_name"=> "health not found"
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

    //insert health data from father {Done} two fun before #7
    public function insertNewHealth($father_id,$child_id,InsertNewHealthRequest $request){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                if($request->medical_analysis != null){
                    $image_name=Storage::putFile("MedicalAnalysis",$request->medical_analysis);
                }else{
                    $image_name=null;
                }
                $healthData = Health::create([
                    "banded_food"=>$request->banded_food,
                    'medicien'=>$request->medicien,
                    'medical_analysis'=>$image_name,
                    'personal_comment'=>$request->personal_comment,
                    'father_id'=>$father_id,
                    'child_id'=>$child_id
                ]);
                $disName = AddHealth::create([
                    "name"=>$request->name,
                    "type"=>$request->type,
                    'father_id'=>$father_id,
                    'child_id'=>$child_id,
                    'health_id'=>$healthData->id
                ]);
                return response()->json([
                    "msg"=>"inserted",
                    "health table data"=>new HealthResource($healthData),
                    "health name"=>new AddHealthResource($disName)
                ],200);
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

    //show child profile {DONE} #11
    public function showChildProfile($father_id,$child_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                if($child->image==null){
                    $imagename=null;
                }else{
                    $imagename=asset("storage")."/".$child->image;
                }
                return response()->json([
                "Child Name" => $child->name,
                "Age"=>$child->age,
                "child Image"=>$imagename,
                "Weight"=>$child->weight,
                "Height"=>$child->height,
                "Child Grade" => $child->grade,
                "Child Class" => $child->class,
                ]);
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

    // show child record {DONE} #12
    public function showChildRecord($father_id,$child_id){
        $father = Father::find($father_id);
        if ($father != null) {
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            $subjects = Subjectdataset::all();
            if ($child != null) {
                if($child->image==null){
                    $imagename=null;
                }else{
                    $imagename=asset("storage")."/".$child->image;
                }
                return response()->json([
                    "child_name" => $child->name,
                    "child_grade" => $child->grade,
                    "child Image"=>$imagename,
                    "Child Activity"=> $child->childActivitydataset->name,
                    "Activity ID"=>$child->childActivitydataset->id,
                    "Subjects" =>  SubjectdatasetResource::collection($subjects),
                ],200);
            } else {
                return response()->json([
                    "msg" => "your child you must register data for your child"
                ],404);
            }
        } else {
            return response()->json([
                "msg" => "you don't have account, please sign up first"
            ],404);
        }
    }

    //child data for dotor & notifie {DONE} #13
    public function showChildData($father_id,$child_id,){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                if($child->image==null){
                    $imagename=null;
                }else{
                    $imagename=asset("storage")."/".$child->image;
                }
                return response()->json([
                "child Image"=>$imagename,
                "Child Name" => $child->name,
                "Child Grade" => $child->grade,
                "Child Class" => $child->class,
                ],200);
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

    //show health name that child has
    public function showHealthNameFather($father_id,$child_id){
        $father = Father::where("id",$father_id)->first();
        if ($father != null){
            $child = Child::where("id","=",$child_id)->where("id",$father_id)->first();
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

    //show health data for his child {DONE} #14
    public function showHealthDataFather($father_id, $child_id,$healthdatasetname_id){
        $father = Father::where("id", $father_id)->first();
        if ($father != null) {
            $child = Child::where("id", "=", $child_id)->where("id",$father_id)->first();
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

    //update health data for child {DONE} ----- #15
    public function updateHealthData($father_id,$child_id,$healthdatasetname_id, Request $request){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                $health_name = Healthdatasetname::find($healthdatasetname_id);
                if($health_name!=null){
                    $healthData = Health::where("child_id","=",$child_id)->first();
                    if($healthData!= null){
                        //very important اهدى خالص.
                        $pivot_namedata= $health_name->healthdatasetnameHealth->first()->pivot->
                        where("health_id",$healthData->id)->
                        where("healthdatasetname_id",$healthdatasetname_id)->get();
                        //health id from pivot table healthdatasetname_health
                        $health_id=$pivot_namedata->first()->health_id;
                        $health_type = Healthdatasettype::where("healthdatasetname_id","=",$healthdatasetname_id)->first();
                        if($health_type!=null){
                            //to compare health_id with the getting health id from pivot table healthdatasetname_health
                            //and to show the health id and healthdatasettype_id from pivot table healthdatasettype_health
                            $pivot_typedata= $health_type->healthdatasettypeHealth->first()->pivot
                            ->where("health_id",$health_id)->first();
                            $type_id=$pivot_typedata->healthdatasettype_id;
                            $selected_type = Healthdatasettype::where("id",$type_id)->first();
                            //to show all types in this dis
                            $health_typeall = Healthdatasettype::where("healthdatasetname_id","=",$healthdatasetname_id)->get();
                            $alltypes=[];

                            $old_med= $healthData->medicien;
                            $old_type=$selected_type->dis_type;


                            foreach ($health_typeall as $type) {
                                $alltypes[]=$type->dis_type;
                            }
                            $va = Validator::make($request->all(),[
                                "dis_type"=>["required",Rule::in($alltypes)],
                                "medicien"=>"string|max:100",
                            ]);
                            if($va->fails()){
                                return response()->json([
                                    "msg"=>$va->errors()
                                ],404);
                            }else{
                                $healthData->update([
                                    'medicien'=>$request->medicien,
                                    'father_id'=>$father_id,
                                    'child_id'=>$child_id,
                                ]);
                                $inserted_type = Healthdatasettype::where("dis_type","=",$request->dis_type)->first();
                                $healthData->healthHealthdatasettype()->syncWithoutDetaching($inserted_type->id);
                                return response()->json([
                                    "All Type"=>$alltypes,
                                    "Old Type"=>$old_type,
                                    "Old Medicain"=>$old_med,
                                    "Msg" => "inserted",
                                    "New Type"=>$inserted_type->dis_type,
                                    "Inserted Data" => new HealthResource($healthData)
                                ],200);
                            }
                        }else{
                            return response()->json([
                                "dis_name"=> "health has no type"
                            ],404);
                        }
                    }else{
                        return response()->json([
                            "msg"=>"has no health id"
                        ],404);
                    }
                }else{
                    return response()->json([
                        "dis_name"=> "health not found"
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

    //show personal comment {DONE} #16
    public function showHealthComment($father_id,$child_id,$healthdatasetname_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
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
                    "dis_name"=> "you must set data for your child"
                ],404);
            }
        }else{
            return response()->json([
                "msg" => "you don't have account, please sign up first"
            ],404);
        }
    }

    //delete personal comment {DONE} #17
    public function deleteHealthComment($father_id,$child_id,$healthdatasetname_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
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
                            $healthData->update([
                                "personal_comment"=>null
                            ]);
                            return response()->json([
                                "msg"=>"deleted",
                                "Data" => new PersonalCommentResource($healthData)
                            ],200);
                        }else{
                            return response()->json([
                                "msg"=>"invaild id"
                            ],404);
                        }
                    }else{
                        return response()->json([
                            "msg"=>"has no health id name"
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

    //update personal comment {DONE} #18
    public function updateHealthComment($father_id,$child_id,$healthdatasetname_id,Request $request){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
            if ($child != null) {
                $health_name = Healthdatasetname::find($healthdatasetname_id);
                if($health_name!=null){
                    // $healthData = Health::where("child_id","=",$child_id)->first();
                    // $healthData = Health::where("child_id","=",$child_id)->first();
                    //عشان نجيب ال فى بايفوت بال health name id
                    //وكده ال pivot_namedata فيه ال health_id ال يخص ال healthname_id دا
                    $pivot_namedata= $health_name->healthdatasetnameHealth->first()->pivot->
                    where("healthdatasetname_id",$healthdatasetname_id)->get();
                    //ها اجيب ال داتا بتاعت ال healthid دا
                    $healthData = Health::where("child_id","=",$child_id)->where("id",$pivot_namedata->first()->health_id)->first();
                    if($healthData!= null){
                        // //very important اهدى خالص.
                        // $pivot_namedata= $health_name->healthdatasetnameHealth->first()->pivot->
                        // where("health_id",$healthData->id)->
                        // where("healthdatasetname_id",$healthdatasetname_id)->get();
                        // //health id from pivot table healthdatasetname_health
                        // $health_id=$pivot_namedata->first()->health_id;
                        // $healthDatain = Health::where("id","=",$health_id)->first();
                        // if($healthDatain!=null){
                            $va = Validator::make($request->all(),[
                                "personal_comment"=>"string|max:100",
                            ]);
                            if($va->fails()){
                                return response()->json([
                                    "msg"=>$va->errors()
                                ],404);
                            }else{
                                $healthData->update([
                                    "personal_comment"=>$request->personal_comment
                                ]);
                                return response()->json([
                                    "msg"=>"updated",
                                    "Data" => new PersonalCommentResource($healthData)
                                ],404);
                            }
                        }else{
                            return response()->json([
                                "msg"=>"invaild id"
                            ],404);
                        }
                    }else{
                        return response()->json([
                            "msg"=>"has no health id name in piovit"
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

    //show  medical analysis {DONE} #19
    public function showHealthMedical($father_id,$child_id,$healthdatasetname_id){
            $father = Father::find($father_id);
            if ($father != null){
                $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
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
                                ],200);
                            }else{
                                return response()->json([
                                    "msg"=>"has no medical uploaded"
                                ],404);
                            }
                    }else{
                        return response()->json([
                            "dis_name"=> "health not found"
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

    //delete medical analysis {DONE} #20
    public function deleteHealthMedical($father_id,$child_id,$healthdatasetname_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
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
                    if($healthData->medical_analysis!=null){
                            Storage::delete($healthData->medical_analysis);
                            $healthData->update([
                                "medical_analysis"=>null
                            ]);
                            return response()->json([
                                "msg"=>"deleted",
                                "Data" => $healthData->medical_analysis
                            ],200);
                        }else{
                            return response()->json([
                                "msg"=>"no medical uploaded"
                            ],404);
                        }
                    }else{
                        return response()->json([
                            "msg"=>"has no health id name"
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

    //update medical analysis #21
    public function updateHealthMedical($father_id,$child_id,$healthdatasetname_id,Request $request){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id","=",$child_id)->first();
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
                    if($healthData!=null){
                        //very important اهدى خالص.
                        // $pivot_namedata= $health_name->healthdatasetnameHealth->first()->pivot->
                        // where("health_id",$healthData->id)->
                        // where("healthdatasetname_id",$healthdatasetname_id)->get();
                        // //health id from pivot table healthdatasetname_health
                        // $health_id=$pivot_namedata->first()->health_id;
                        // $healthDatain = Health::where("id","=",$health_id)->first();
                        // if($healthData->medical_analysis!=null){
                            if ($request->hasFile("medical_analysis")) {
                                //if we have image in the file but we don't have now so comment it
                                if($healthData->medical_analysis!=null){
                                    Storage::delete($healthData->medical_analysis);
                                    $new_medical = Storage::putFile("MedicalAnalysis", $request->medical_analysis); //rename - uploads
                                    $healthData->update([
                                        "medical_analysis"=>$new_medical
                                    ]);
                                    return response()->json([
                                        "msg"=>"updated",
                                        "Data" => new MidecalAnalysisResource($healthData)
                                    ],200);
                                }
                                elseif($healthData->medical_analysis==null){
                                    $new_medical = Storage::putFile("MedicalAnalysis", $request->medical_analysis); //rename - uploads
                                    $healthData->update([
                                        "medical_analysis"=>$new_medical
                                    ]);
                                    return response()->json([
                                        "msg"=>"updated",
                                        "Data" => new MidecalAnalysisResource($healthData)
                                    ],200);
                                }
                            }
                        }else{
                            return response()->json([
                                "msg"=>"no health for this here"
                            ],404);
                        }
                    }else{
                        return response()->json([
                            "msg"=>"has no health id name"
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

    //show allowed food {DONE} "we need to make fun for show banded food" #22
    public function showSelectedFood($father_id, $child_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id", "=", $child_id)->first();
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
                        if($child->image != null){
                            $imagename = asset("storage")."/".$child->image;
                        }else{
                            $imagename = null;
                        }
                        return response()->json([
                            "child Image" => $imagename,
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
                        "msg" => "You must register data for your Child"
                    ],404);
                }
        }else {
                return response()->json([
                    "msg" => "You Don’t Have Account,Please Sign up First"
                ], 404);
            }
    }

    //show banded food function {DONE}
    public function showBandedFood($father_id, $child_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id", "=", $child_id)->first();
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
                        "msg" => "You must register data for your Child"
                    ],404);
                }
        }else {
                return response()->json([
                    "msg" => "You Don’t Have Account,Please Sign up First"
                ], 404);
            }
    }

    //show subject and attendance to father {Done}
    public function showSubjectData($father_id, $child_id, $subjectdataset_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id", "=", $child_id)->first();
            if ($child != null){
                $all = Attendence::where("child_id",$child_id)->where("attendence_status","Absence")->get();
                $sub_name = Subjectdataset::select("name")->where("id",$subjectdataset_id)->first();
                $pivot_subjectdata= $child->subjectChild->first()->pivot->
                where("child_id",$child_id)->get();
                $sub_data = Subject::where("id",$pivot_subjectdata->first()->subject_id)->first();
                return response()->json([
                    "Subject Name"=>$sub_name ,
                    "Attendance"=> AttendanceResource::collection($all),
                    "Subject Data"=> new SubjectResource($sub_data)
                ]);
            }else {
                    return response()->json([
                        "msg" => "You must register data for your Child"
                    ],404);
                }
        }else {
                return response()->json([
                    "msg" => "You Don’t Have Account,Please Sign up First"
                ], 404);
            }
    }

    //show activity data for father {DONE]
    public function showActivityData($father_id, $child_id, $activitydataset_id){
        $father = Father::find($father_id);
        if ($father != null){
            $child = Child::where("father_id", "=", $father->id)->where("id", "=", $child_id)->where("activitydataset_id",$activitydataset_id)->first();
            if ($child != null){
                $act_name = Activitydataset::select("name")->where("id",$activitydataset_id)->first();
                $act_data = Activity::where("child_id",$child_id)->first();
                if($act_data!=null){
                    return response()->json([
                        "Activity Name"=>$act_name ,
                        "Activity Data"=> new ActivityResource($act_data)
                    ]);
                }else {
                    return response()->json([
                        "msg" => "not vaild data now"
                    ],404);
                }
            }else {
                    return response()->json([
                        "msg" => "wrong activity"
                    ],404);
                }
        }else {
                return response()->json([
                    "msg" => "You Don’t Have Account,Please Sign up First"
                ], 404);
            }
    }

    //show all speacial childs for emp {DONE}
    public function showSpecialChild($emp_id){
        $emp = Employee::find($emp_id);
        if($emp !=null && $emp->job_title== 'Doctor'){
        $special_child = Child::where('health_condition','=', 'special')->orderby('grade')->get();
        if ($special_child != null) {
            return response()->json([
                "special children" => ChildDataResource::collection($special_child),
            ]);
        } else {
            return response()->json([
                "msg" => "No Data Here"
            ]);
        }
        }else {
            return response()->json([
                "msg" => "Access Denied"
            ]);
        }
    }

    //show all child for emp {DONE} manager Specialist
    public function showAllChild($emp_id){
        $emp = Employee::where("id",$emp_id)->where("job_title","!=","Seller")->first();
        if($emp !=null){
            $childs = Child::all();
            if ($childs != null) {
                return response()->json([
                    'all children' => ChildDataResource::collection($childs),
                ]);
            } else {
                return response()->json([
                    "msg" => "No Data Here"
                ]);
            }
        }else{
            return response()->json([
                "msg" => "Data Not Found"
            ],404);
        }
    }

    //to return qr code for watch {DONE}
    public function returnQrcode($child_code){
        $child=Child::select("qr_code")->where("child_code",$child_code)->first();
        if($child != null){
            return response()->json([
                 new QrcodeResource($child)
            ],200);
        }else{
            return response()->json([
                "msg" => "uncorrect child code"
            ],404);
        }
    }

    //to check child code
    public function checkChildCode(Request $request){
        $va = Validator::make($request->all(),[
            "child_code"=>"required|string|max:6",
        ]);
        if($va->fails()){
            return response()->json([
                $va->errors()
            ],404);
        }else{
            $check=Child::whereRaw('BINARY `child_code` = ?', $request->child_code)->first();
            if($check){
                return response()->json([
                    true
                ],200);
            }else{
                return response()->json([
                    false
                ],404);
            }
        }
    }

    //create qr code for all children
    public function makeQRAll(){
        $allchildren = Child::all();
        foreach ($allchildren as $child) {
            $child_code = Str::random(6);
            $random_string = Str::random(10);
            $qr_text = $random_string;
            $qr_name = Str::random(25).".png";
            $qr=QrCode::format('png')->style('round')->size(200)->generate($qr_text);
            $q=Storage::disk('public')->put('QrCodes/'.$qr_name, $qr);
            $child->update([
                "qr_code"=>$qr_name,
                "child_code"=>$child_code,
                "qr_string"=>$qr_text
            ]);
        }
    }
    public function deleteFolder($folderName)
    {
        // Get the full path to the folder
        $path = $folderName;

        // Check if the folder exists
        if (Storage::exists($path)) {

            // Delete all files within the folder
            Storage::deleteDirectory($path);

            // Optionally, you can also delete the empty folder left behind
            Storage::deleteDirectory($path);

            // Return a success message
            return 'Folder deleted successfully.';
        } else {

            // Return an error message
            return 'Folder not found.';
        }
    }

}
