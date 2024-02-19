<?php

namespace App\Http\Controllers;

use App\Mail\WatchCode;
use App\Models\Child;
use App\Models\Father;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function getCode($father_id,$child_id){
        $father=Father::find($father_id);
        if($father != null){
            $child=Child::find($child_id);
            if($child != null){
                $child_code=Child::select("name","child_code")->where("child_code","<>",null)->where("father_id",$father_id)->first();
                // return view("childCodeEmail",["child_code"=>$child_code]);
                // Mail::send(new WatchCode($child_code));
            }else{

            }
        }else{

        }
    }
}
