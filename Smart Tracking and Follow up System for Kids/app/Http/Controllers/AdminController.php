<?php

namespace App\Http\Controllers;

use App\Models\Activitydataset;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Father;
use App\Models\Food;
use App\Models\Healthdatasetname;
use App\Models\Healthdatasettype;
use App\Models\Subjectdataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AdminController extends Controller
{
    //login
    public function loginPage(){
        return view("Dashboard.login"); 
    }

    //handle login
    public function handleLogin(Request $request){
        $val=$request->validate([
            "email"=>"required|email",
            "password"=>"required|max:6"
        ]);
        $is_here =Auth::attempt($val);
        if ($is_here != true) {
            return redirect('login')->withErrors('errors');
        }else{
            $admin_id = Auth::user();
            session()->put("id","$admin_id->id");
            return redirect("showallfather");
        }
    }

    //go to add new act
    public function actPage($id){
        $data = Admin::findorfail($id);
        return view("Dashboard.NewActivity",compact("data"));
    }

    //new act handle
    public function handleAct($id,Request $request){
        $val=$request->validate([
            "newActivity"=>"required|string",
        ]);

        Activitydataset::create([
            "name"=>$request->newActivity,
            "admin_id"=>$id
        ]);

        return redirect('showallactivity');
    }

    //showall activity
    public function showallActivity(){
        $allact = Activitydataset::all();
        return view('Dashboard.allactivity',compact("allact"));
    }

    //delete activity
    public function deleteAct($id){
        $act = Activitydataset::findorfail($id);
        $act->delete();
        return redirect('showallactivity');
    }

    //show all emp
    public function showallEmp(){
        $allemp = Employee::all();
        return view("Dashboard.allemployee",compact("allemp"));
    }

    //delete emp
    public function deleteEmp($id){
        $emp = Employee::findorfail($id);
        $emp->delete();
        return redirect('showallemp');
    }

    //show one
    public function showoneEmp($id){
        $emp = Employee::findorfail($id);
        return view('Dashboard.employeeprofile',compact('emp'));
    }

    //go to add emp form
    public function empPage($id){
        $admin = Admin::findOrFail($id);
        $subs = Subjectdataset::all();
        $acts = Activitydataset::all();
        return view('Dashboard.AddEmployee', compact("admin","subs","acts"));
    }

    //handle add emp
    public function handleEmp($id,Request $request){
        $subs = Subjectdataset::select("id")->get();
        $acts = Activitydataset::select("id")->get();
        $s=[];
        $a=[];
        foreach ($subs as $sub) {
           $s[] = $sub->id;
        }
        foreach ($acts as $act) {
            $a[] = $act->id;
        }
        $val = $request->validate([
            "name" => "required|string|max:100",
            "email" => "required|email",
            "password" => "required|min:8|confirmed",
            "job_title" => ["required", Rule::in(['Doctor', 'Manager', 'Teacher', 'Seller', 'Specialist'])],
            "subject"=> ["nullable",Rule::in($s)],
            "activity"=>["nullable",Rule::in($a)]
        ]);
        $pass =bcrypt($request->password);
        Employee::create([
            "name" => $request->name,
            'email'=>$request->email,
            'password'=>$pass,
            'job_title'=>$request->job_title,
            'subjectdataset_id'=>$request->subject,
            'activitydataset_id'=>$request->activity,
            "admin_id" =>$id
        ]);
        return redirect("showallemp");
    }

    //showall subject
    public function showallSubject(){
        $allsub = Subjectdataset::all();
        return view('Dashboard.subject',compact("allsub"));
    }

    //delete subject
    public function deleteSub($id){
        $sub = Subjectdataset::findorfail($id);
        $sub->delete();
        return redirect('showallsubject');
    }

    //go to add new act
    public function subPage($id){
        $data = Admin::findorfail($id);
        return view("Dashboard.NewSubject",compact("data"));
    }

    //new act handle
    public function handleSub($id,Request $request){
        $val=$request->validate([
            "newSubject"=>"required|string",
        ]);

        Subjectdataset::create([
            "name"=>$request->newSubject,
            "admin_id"=>$id
        ]);

        return redirect('showallsubject');
    }

    //showall desease with types
    public function showallDis(){
        $allname = Healthdatasetname::all();
        return view('Dashboard.disease',compact("allname"));
    }

    //delete desease and type
    public function deleteDis($id){
        $health = Healthdatasetname::findorfail($id);
        $health->healthdatasetnameType()->delete();
        $health->delete();
        return redirect('showalldis');
    }

    //add new type
    public function typePage($admin_id,$healthname_id){
        $admin = Admin::findorfail($admin_id);
        $health = Healthdatasetname::where("id",$healthname_id)->first();
        if($health != null){
            return view("Dashboard.NewType",compact("admin","health"));
        }else{
            return abort("404");
        }
    }

    //handle new type
    public function handleType($admin_id, $healthname_id, Request $request){
        $val = $request->validate([
            "newtype" => "required|string",
        ]);
        Healthdatasettype::create([
            "dis_type" => $request->newtype,
            "admin_id" => $admin_id,
            'healthdatasetname_id'=> $healthname_id
        ]);
        return redirect('showalldis');
    }

    //go to add new des
    public function disPage($id){
        $admin = Admin::findorfail($id);
        return view("Dashboard.NewDisease",compact("admin"));
    }

    //new des handle
    public function handleDis($id,Request $request){
        $val=$request->validate([
            "newname"=>"required|string",
        ]);

        Healthdatasetname::create([
            "dis_name"=>$request->newname,
            "admin_id"=>$id
        ]);

        return redirect('showalldis');
    }

    //showall desease with types
    public function showallFood(){
        $allfood = Food::all();
        return view('Dashboard.food',compact("allfood"));
    }

    //delete desease and type
    public function deleteFood($id){
        $food = Food::findorfail($id);
        $food->delete();
        return redirect('showallfood');
    }

    //go to add new act
    public function foodPage($id){
        $admin = Admin::findorfail($id);
        return view("Dashboard.newFood",compact("admin"));
    }

    //new act handle
    public function handleFood($id,Request $request){
        $val=$request->validate([
            "name"=>"required|string",
            "calories"=>"required"
        ]);

        Food::create([
            "name"=>$request->name,
            "calories"=>$request->calories,
            "admin_id"=>$id
        ]);

        return redirect('showallfood');
    }

    //showall father
    public function showallFather(){
        $allfather = Father::all();
        return view('Dashboard.allfather',compact("allfather"));
    }

    //new act handle
    public function handleFather($father_id,Request $request){
        $father =Father::findorfail($father_id);
        $val=$request->validate([
            "radio"=>["required",Rule::in("accepted","rejected")],
        ]);
        $father->update([
            "status"=>$request->radio
        ]);
        return redirect('showallfather');
    }

    //delete father
    public function deleteFather($id){
        $father = Father::findorfail($id);
        $father->delete();
        return redirect('showallfather');
    }
}
