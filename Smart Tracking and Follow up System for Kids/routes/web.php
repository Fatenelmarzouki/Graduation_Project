<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\MailController;
use App\Mail\WatchCode;
use App\Models\Child;
use App\Models\Father;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('sendcode/{father_id}/{child_id}', function($father_id,$child_id){
    $father=Father::find($father_id);
    if($father != null){
        $child=Child::find($child_id);
        if($child != null){
            $child_code=Child::select("name","child_code")->where("child_code","<>",null)->where("father_id",$father_id)->first();
            Mail::send(new WatchCode($child_code));
        }else{

        }
    }else{

    } 
});

Route::get("login",[AdminController::class,"loginPage"]);
Route::Post("access",[AdminController::class,"handleLogin"]);

Route::get("act/{id}",[AdminController::class,"actPage"]);
Route::Post("newact/{id}",[AdminController::class,"handleAct"]);

Route::get("showallactivity",[AdminController::class,"showallActivity"]);

Route::delete("deleteact/{id}",[AdminController::class,"deleteAct"]);

Route::get("showallemp",[AdminController::class,"showallEmp"]);
Route::get("showoneemp/{id}",[AdminController::class,"showoneEmp"]);

Route::delete("deleteemp/{id}",[AdminController::class,"deleteEmp"]);

Route::get("newemp/{id}",[AdminController::class,"empPage"]);
Route::post("handleemp/{id}",[AdminController::class,"handleEmp"]);

Route::get("showallsubject", [AdminController::class, "showallSubject"]);
Route::delete("deletesub/{id}", [AdminController::class,"deleteSub"]);

Route::get("sub/{id}",[AdminController::class,"subPage"]);
Route::Post("newsub/{id}",[AdminController::class,"handleSub"]);

Route::get("showalldis", [AdminController::class, "showallDis"]);
Route::delete("deletedis/{id}", [AdminController::class,"deleteDis"]);

Route::get('type/{admin_id}/{healthname_id}', [AdminController::class, 'typePage']);
Route::post('newtype/{admin_id}/{healthname_id}', [AdminController::class,'handleType']);

//new dis
Route::get('dis/{id}', [AdminController::class, 'disPage']);
Route::post('newdis/{id}', [AdminController::class, 'handleDis']);

Route::get("showallfood", [AdminController::class, "showallFood"]);
Route::delete("deletefood/{id}", [AdminController::class,"deleteFood"]);

//new food
Route::get('newfood/{id}', [AdminController::class, 'foodPage']);
Route::post('handlefood/{id}', [AdminController::class, 'handleFood']);

Route::get("showallfather", [AdminController::class, "showallFather"]);
Route::post('handlefatherstatus/{father_id}', [AdminController::class, 'handleFather']);
Route::delete("deletefather/{id}", [AdminController::class,"deleteFather"]);