<?php

use App\Http\Controllers\ChildController;
use App\Http\Controllers\EmpDoctorController;
use App\Http\Controllers\EmployeesProfileController;
use App\Http\Controllers\EmpManagerController;
use App\Http\Controllers\EmpSpecialistController;
use App\Http\Controllers\EmpTeacherController;
use App\Http\Controllers\FatherController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SelectedfoodController;
use App\Http\Controllers\ShowdiseaseController;
use App\Http\Controllers\WatchDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Father Cycle
Route::post("signup",[FatherController::class,"register"]);  //http://127.0.0.1:8000/api/signup
Route::put("login",[LoginController::class,"access"]);  //http://127.0.0.1:8000/api/login?_method=put
Route::get("allActivity",[ChildController::class,"showAllActivity"]); //http://127.0.0.1:8000/api/allActivity
Route::post("signupChild/{father_id}",[ChildController::class,"RegisterChild"]); //http://127.0.0.1:8000/api/signupChild/1
Route::get("showAllDiseases/{father_id}/{child_id}",[ShowdiseaseController::class,"showDis"]);//http://127.0.0.1:8000/api/showAllDiseases/1/1
Route::get("showhealthnametype/{father_id}/{child_id}/{healthdatasetname_id}",[ChildController::class,"showHealthNameType"]); //http://127.0.0.1:8000/api/showhealthnametype/5/2/1
Route::post("showDis/inserthealth/{father_id}/{child_id}/{healthdatasetname_id}",[ChildController::class,"showHealthGetFather"]); //http://127.0.0.1:8000/api/showDis/inserthealth/5/2/2
Route::get("diet/{father_id}/{child_id}/{healthdatasetname_id}",[FoodController::class,"showAllFood"]); //http://127.0.0.1:8000/api/diet/5/2/5
Route::post("addhealth/{father_id}/{child_id}",[ChildController::class,"insertNewHealth"]); //http://127.0.0.1:8000/api/addhealth/5/2
Route::get("fatherprofile/{father_id}",[FatherController::class,"showFather"]); //http://127.0.0.1:8000/api/fatherprofile/1
Route::put("updateprofilefather/{father_id}",[FatherController::class,"editFather"]);//http://127.0.0.1:8000/api/updateprofilefather/1?_method=put
Route::put("updatepasswordfather/{father_id}",[FatherController::class,"editFatherPassword"]); //http://127.0.0.1:8000/api/updatepasswordfather/19?_method=put
Route::get('childprofile/{father_id}/{child_id}', [ChildController::class, 'showChildProfile']); //http://127.0.0.1:8000/api/childprofile/1/1
Route::get('childstudy/{father_id}/{child_id}', [ChildController::class, 'showChildRecord']);  //http://127.0.0.1:8000/api/childstudy/1/14
Route::get('childdata/{father_id}/{child_id}',[ChildController::class,"showChildData"]); //http://127.0.0.1:8000/api/childdata/1/14

Route::get("showhealthnamefather/{father_id}/{child_id}",[ChildController::class,"showHealthNameFather"]); //http://127.0.0.1:8000/api/showhealthnamefather/1/1
Route::get("showhealthdatafather/{father_id}/{child_id}/{healthdatasetname_id}",[ChildController::class,"showHealthDataFather"]); //http://127.0.0.1:8000/api/showhealthdatafather/7/1/2

Route::put("updatehealth/{father_id}/{child_id}/{healthdatasetname_id}",[ChildController::class,"updateHealthData"]);//http://127.0.0.1:8000/api/updatehealth/5/2/3?_method=put
Route::get("showpersonalcomment/{father_id}/{child_id}/{healthdatasetname_id}",[ChildController::class,"showHealthComment"]);//http://127.0.0.1:8000/api/showpersonalcomment/5/2/1
Route::put("deletepersonnalcomment/{father_id}/{child_id}/{healthdatasetname_id}",[ChildController::class,"deleteHealthComment"]);//http://127.0.0.1:8000/api/deletepersonnalcomment/5/2/1?_method=put
Route::put("updatepersonnalcomment/{father_id}/{child_id}/{healthdatasetname_id}",[ChildController::class,"updateHealthComment"]);//http://127.0.0.1:8000/api/updatepersonnalcomment/5/2/1?_method=put
Route::get("showpersonalmedical/{father_id}/{child_id}/{healthdatasetname_id}",[ChildController::class,"showHealthMedical"]);//http://127.0.0.1:8000/api/showpersonalmedical/5/2/1
Route::put("deletepersonalmedical/{father_id}/{child_id}/{healthdatasetname_id}",[ChildController::class,"deleteHealthMedical"]);//http://127.0.0.1:8000/api/deletepersonalmedical/5/2/1?_method=put
Route::put("updatepersonalmedical/{father_id}/{child_id}/{healthdatasetname_id}",[ChildController::class,"updateHealthMedical"]);//http://127.0.0.1:8000/api/updatepersonalmedical/5/2/1?_method=put
Route::get('showallowedfood/{father_id}/{child_id}', [ChildController::class,'showSelectedFood']);//http://127.0.0.1:8000/api/showallowedfood/1/1
Route::get("fatherhealthreport/{father_id}/{child_id}",[ReportController::class,"showAllHealth"]);//http://127.0.0.1:8000/api/fatherhealthreport/1/1
Route::get("fatherstudyreport/{father_id}/{child_id}/{subjectdataset_id}",[ReportController::class,"showAllStudy"]);//http://127.0.0.1:8000/api/fatherstudyreport/1/1
Route::get("fatheronestudy/{father_id}/{child_id}/{subjectdataset_id}/{report_id}",[ReportController::class,"showOneStudy"]);//http://127.0.0.1:8000/api/fatheronestudy/1/1/2
Route::get("fatheronehealth/{father_id}/{child_id}/{report_id}",[ReportController::class,"showOneHealth"]);//http://127.0.0.1:8000/api/fatheronehealth/1/1/3
Route::post("getfatherselect/{father_id}/{child_id}/{healthdatasetname_id}", [SelectedfoodController::class,"insertSelectedFood"]); //http://127.0.0.1:8000/api/getfatherselect/5/2/5
Route::post("getfatherselectbandfood/{father_id}/{child_id}/{healthdatasetname_id}", [SelectedfoodController::class,"insertBandedFood"]); //http://127.0.0.1:8000/api/getfatherselectbandfood/5/2/5
Route::get("showband/{father_id}/{child_id}",[ChildController::class,"showBandedFood"]); //http://127.0.0.1:8000/api/showband/5/2
Route::get("showsub/{father_id}/{child_id}/{subjectdataset_id}",[ChildController::class,"showSubjectData"]); //http://127.0.0.1:8000/api/showsub/1/1/4
Route::get("showact/{father_id}/{child_id}/{activitydataset_id}",[ChildController::class,"showActivityData"]); //http://127.0.0.1:8000/api/showact/1/1/3
Route::get('allposts/{father_id}/{child_id}', [PostController::class, 'showAllPost']); //http://127.0.0.1:8000/api/allposts/5/2
Route::get('onepost/{father_id}/{child_id}/{post_id}', [PostController::class, 'showOnePost']);  //http://127.0.0.1:8000/api/onepost/5/2/4
Route::put('addreplay/{father_id}/{child_id}/{post_id}', [PostController::class, 'addReplay']);  //http://127.0.0.1:8000/api/addreplay/5/2/11?_method=put
//added new links (show all activity reports and show one activity report)
Route::get("fatheractivityreport/{father_id}/{child_id}/{activitydataset_id}",[ReportController::class, "showAllActivity"]);//http://127.0.0.1:8000/api/fatheractivityreport/1/1/3
Route::get("fatheroneactivity/{father_id}/{child_id}/{activitydataset_id}/{report_id}",[ReportController::class, "showOneActivity"]);//http://127.0.0.1:8000/api/fatheroneactivity/1/1/3/2

//watch part
Route::get('showqr/{child_code}', [ChildController::class, 'returnQrcode']);  //http://127.0.0.1:8000/api/showqr/
Route::post('checkcode', [ChildController::class, 'checkChildCode']);  //http://127.0.0.1:8000/api/checkcode
Route::post('addheart/{child_code}',[WatchDataController::class,'getHeartRate']); //http://127.0.0.1:8000/api/addheart

//Doctor Cycle
Route::put("login",[LoginController::class,"access"]);  //http://127.0.0.1:8000/api/login?_method=put
Route::get('allchildren/{emp_id}', [ChildController::class, 'showAllChild']); //http://127.0.0.1:8000/api/allchildren/7
Route::get('specialchildren/{emp_id}', [ChildController::class, 'showSpecialChild']); //http://127.0.0.1:8000/api/specialchildren/7
Route::get('childdatafordoc/{emp_id}/{child_id}',[EmpDoctorController::class,"showChildDataDoc"]); //http://127.0.0.1:8000/api/childdatafordoc/7/14
Route::post("addReport/{child_id}/{emp_id}",[ReportController::class,"addReport"]);//http://127.0.0.1:8000/api/addReport/7/2
Route::get("emphealthreport/{emp_id}/{child_id}",[ReportController::class,"showAllHealthEmp"]);//http://127.0.0.1:8000/api/emphealthreport/7/4
Route::get("emponehealth/{emp_id}/{child_id}/{report_id}", [ReportController::class, "showOneHealthEmp"]); //http://127.0.0.1:8000/api/emponehealth/7/4/10
Route::get("showprofile/{emp_id}",[EmployeesProfileController::class,"ShowProfile"]); //http://127.0.0.1:8000/api/showprofile/7
Route::put("editprofile/{emp_id}",[EmployeesProfileController::class,"UpdateProfile"]); //http://127.0.0.1:8000/api/editprofile/7?_method=put
Route::get('childprofiledoc/{emp_id}/{child_id}', [EmpDoctorController::class, 'showChildProfileDoc']); //http://127.0.0.1:8000/api/childprofiledoc/7/14
Route::get("showhealthnamedoc/{emp_id}/{child_id}",[EmpDoctorController::class,"showHealthNameDoc"]); //http://127.0.0.1:8000/api/showhealthnamedoc/7/14
Route::get("showhealthdoc/{emp_id}/{child_id}/{healthdatasetname_id}",[EmpDoctorController::class,"showHealthDataDoc"]); //http://127.0.0.1:8000/api/showhealthdoc/7/1/2
Route::get("showpersonalmedicaldoc/{emp_id}/{child_id}/{healthdatasetname_id}",[EmpDoctorController::class,"showHealthMedicalDoc"]);//http://127.0.0.1:8000/api/showpersonalmedicaldoc/7/2/1
Route::get("showpersonalcommentdoc/{emp_id}/{child_id}/{healthdatasetname_id}",[EmpDoctorController::class,"showHealthCommentDoc"]);//http://127.0.0.1:8000/api/showpersonalcommentdoc/7/2/1
Route::get('showallowedfooddoc/{emp_id}/{child_id}', [EmpDoctorController::class,'showSelectedFoodDoc']);//http://127.0.0.1:8000/api/showallowedfooddoc/7/2
Route::get("showbanddoc/{emp_id}/{child_id}",[EmpDoctorController::class,"showBandedFoodDoc"]); //http://127.0.0.1:8000/api/showbanddoc/7/2

//Employee subject Teacher cycle
Route::put("login",[LoginController::class,"access"]);  //http://127.0.0.1:8000/api/login?_method=put
Route::get("showallchildgrade/{emp_id}/{subjectdataset_id}/{grade}/{class}",[EmpTeacherController::class,'showAllChildTeacher']); //http://127.0.0.1:8000/api/showallchildgrade/10/1/1/C
Route::post("insertsub/{emp_id}/{subjectdataset_id}/{grade}/{class}/{child_id}",[EmpTeacherController::class,'insertSubjectData']); //http://127.0.0.1:8000/api/insertsub/2/4/1/C/7
Route::get("showallchildabsence/{emp_id}/{subjectdataset_id}/{grade}/{class}/{child_id}",[EmpTeacherController::class,'showAttendanceEmp']); //http://127.0.0.1:8000/api/showallchildabsence/2/4/1/C/7
Route::post('absence/{emp_id}/{subjectdataset_id}/{grade}/{class}/{child_id}',[EmpTeacherController::class,'insertAttendance']); //http://127.0.0.1:8000/api/absence/2/4/1/C/7
Route::get("empstudyreport/{emp_id}/{subjectdataset_id}/{grade}/{class}/{child_id}",[EmpTeacherController::class,"showAllStudyTeacher"]); //http://127.0.0.1:8000/api/empstudyreport/2/4/1/C/7
Route::get("emponestudy/{emp_id}/{subjectdataset_id}/{grade}/{class}/{child_id}/{report_id}", [EmpTeacherController::class, "showOneStudyTeacher"]); //http://127.0.0.1:8000/api/emponestudy/2/4/1/C/7/17
Route::post("insertstudyreport/{emp_id}/{subjectdataset_id}/{grade}/{class}/{child_id}", [EmpTeacherController::class, "addStudyReportTeacher"]); //http://127.0.0.1:8000/api/insertstudyreport/2/4/1/C/7/17
Route::get("subname/{emp_id}/{subjectdataset_id}/{grade}/{class}/{child_id}",[EmpTeacherController::class, 'showSubjectName']); //http://127.0.0.1:8000/api/subname/2/4/1/C/7
Route::get("showprofile/{emp_id}",[EmployeesProfileController::class,"ShowProfile"]); //http://127.0.0.1:8000/api/showprofile/7
Route::put("editprofile/{emp_id}",[EmployeesProfileController::class,"UpdateProfile"]); //http://127.0.0.1:8000/api/editprofile/7?_method=put

//Employee Activity Teacher cycle
Route::put("login",[LoginController::class,"access"]);  //http://127.0.0.1:8000/api/login?_method=put
Route::get("showallchildact/{emp_id}/{activitydataset_id}/{grade}/{class}",[EmpTeacherController::class,'showAllChildActivity']);  //http://127.0.0.1:8000/api/showallchildact/4/5/1/C
Route::post("insertact/{emp_id}/{activitydataset_id}/{grade}/{class}/{child_id}",[EmpTeacherController::class,'insertActivityData']); //http://127.0.0.1:8000/api/insertact/4/5/1/C
Route::get("empactivityreport/{emp_id}/{activitydataset_id}/{grade}/{class}/{child_id}",[EmpTeacherController::class,"showAllActivityTeacher"]); //http://127.0.0.1:8000/api/empactivityreport/4/5/3/C/3
Route::get("emponeactivityreport/{emp_id}/{activitydataset_id}/{grade}/{class}/{child_id}/{report_id}", [EmpTeacherController::class, "showOneActivityTeacher"]); //http://127.0.0.1:8000/api/emponeactivityreport/4/5/3/C/3/8
Route::post("insertactivityreport/{emp_id}/{activitydataset_id}/{grade}/{class}/{child_id}", [EmpTeacherController::class, "addActivityReportTeacher"]); //http://127.0.0.1:8000/api/insertactivityreport/4/5/3/C/3
Route::get("actname/{emp_id}/{activitydataset_id}/{grade}/{class}/{child_id}",[EmpTeacherController::class, 'showActivityName']); //http://127.0.0.1:8000/api/actname/4/5/1/C/8
Route::get("showprofile/{emp_id}",[EmployeesProfileController::class,"ShowProfile"]); //http://127.0.0.1:8000/api/showprofile/4
Route::put("editprofile/{emp_id}",[EmployeesProfileController::class,"UpdateProfile"]); //http://127.0.0.1:8000/api/editprofile/4?_method=put
Route::put("updatepasswordemp/{emp_id}", [EmployeesProfileController::class, "editEmpPassword"]); //http://127.0.0.1:8000/api/updatepasswordemp/19?_method=put

//Manager Cycle
Route::put("login",[LoginController::class,"access"]);  //http://127.0.0.1:8000/api/login?_method=put
Route::get("showallchildgradeManager/{emp_id}/{grade}/{class}",[EmpManagerController::class,"showAllChildManager"]);//http://127.0.0.1:8000/api/showallchildgradeManager/9/1/C
Route::get("showonechildManager/{emp_id}/{grade}/{class}/{child_id}", [EmpManagerController::class, 'showOneChildManager']); //http://127.0.0.1:8000/api/showonechildManager/9/1/C/7
Route::get("showchildprofileManager/{emp_id}/{grade}/{class}/{child_id}", [EmpManagerController::class, 'showChildProfileManager']); //http://127.0.0.1:8000/api/showchildprofileManager/9/1/C/7
Route::get("showchiledallowedfoodManager/{emp_id}/{grade}/{class}/{child_id}", [EmpManagerController::class, 'showSelectedFoodManager']); //http://127.0.0.1:8000/api/showchiledallowedfoodManager/9/1/C/7
Route::get("showBandedFoodchildManager/{emp_id}/{grade}/{class}/{child_id}", [EmpManagerController::class, 'showBandedFoodManager']); //http://127.0.0.1:8000/api/showBandedFoodchildManager/9/1/C/7
Route::get("showhealthnamemanager/{emp_id}/{grade}/{class}/{child_id}",[EmpManagerController::class,"showHealthNameManager"]); //http://127.0.0.1:8000/api/showhealthnamemanager/9/1/B/1
Route::get("showhealthdataManager/{emp_id}/{grade}/{class}/{child_id}/{healthdatasetname_id}",[EmpManagerController::class,"showHealthDataManager"]); //http://127.0.0.1:8000/api/showhealthdataManager/9/1/B/1
Route::get("showchiledcommentManager/{emp_id}/{grade}/{class}/{child_id}/{healthdatasetname_id}", [EmpManagerController::class, 'showHealthCommentManager']); //http://127.0.0.1:8000/api/showchiledcommentManager/9/1/B/1
Route::get("showchiledmedicalManager/{emp_id}/{grade}/{class}/{child_id}/{healthdatasetname_id}", [EmpManagerController::class, 'showHealthMedicalManager']); //http://127.0.0.1:8000/api/showchiledmedicalManager/9/1/B/1
Route::get("showchildrecordManager/{emp_id}/{grade}/{class}/{child_id}", [EmpManagerController::class, 'showChildRecordManager']);//http://127.0.0.1:8000/api/showchildrecordManager/9/1/C/7
Route::get("showchildsubjectdataManager/{emp_id}/{grade}/{class}/{child_id}/{subjectdataset_id}", [EmpManagerController::class, 'showSubjectDataManager']);//http://127.0.0.1:8000/api/showchildsubjectdataManager/9/1/C/7/1
Route::get("showallchildstudyreportManager/{emp_id}/{grade}/{class}/{child_id}/{subjectdataset_id}", [EmpManagerController::class, 'showAllStudyReportManager']);//http://127.0.0.1:8000/api/showallchildstudyreportManager/9/1/C/7/1
Route::get("showonechildstudyreportManager/{emp_id}/{grade}/{class}/{child_id}/{subjectdataset_id}/{report_id}", [EmpManagerController::class, 'showOneStudyReportManager']);//http://127.0.0.1:8000/api/showonechildstudyreportManager/9/1/C/7/1/17
Route::get("showchildactivityManager/{emp_id}/{grade}/{class}/{child_id}/{activitydataset_id}", [EmpManagerController::class, 'showActivityDataManager']);//http://127.0.0.1:8000/api/showchildactivityManager/9/1/C/7/4
Route::get("showallchildactivityreportManager/{emp_id}/{grade}/{class}/{child_id}/{activitydataset_id}", [EmpManagerController::class, 'showAllActivityReportManager']);//http://127.0.0.1:8000/api/showallchildactivityreportManager/9/1/B/1/3
Route::get("showonechildactivityreportManager/{emp_id}/{grade}/{class}/{child_id}/{activitydataset_id}/{report_id}", [EmpManagerController::class, 'showOneActivityReportManager']);//http://127.0.0.1:8000/api/showonechildactivityreportManager/9/1/B/1/3
Route::get("showprofile/{emp_id}",[EmployeesProfileController::class,"ShowProfile"]); //http://127.0.0.1:8000/api/showprofile/9
Route::put("editprofile/{emp_id}",[EmployeesProfileController::class,"UpdateProfile"]); //http://127.0.0.1:8000/api/editprofile/9?_method=put
//added links (show all health report and show one health report)
Route::get("showallchildhealthreportManager/{emp_id}/{grade}/{class}/{child_id}", [EmpManagerController::class, 'showAllHealthReportManager']);//http://127.0.0.1:8000/api/showallchildhealthreportManager/9/1/B/1
Route::get("showonechildhealthreportManager/{emp_id}/{grade}/{class}/{child_id}/{report_id}", [EmpManagerController::class, 'showOneHealthReportManager']);//http://127.0.0.1:8000/api/showonechildhealthreportManager/9/3/C/3/8

//Employee Specialist
Route::put("login",[LoginController::class,"access"]);  //http://127.0.0.1:8000/api/login?_method=put
Route::get("showallchildgradeSpecialist/{emp_id}/{grade}/{class}",[EmpSpecialistController::class,"showAllChildSpecialist"]);//http://127.0.0.1:8000/api/showallchildgradeSpecialist/8/1/B
Route::get("showchildprofileSpecialist/{emp_id}/{grade}/{class}/{child_id}", [EmpSpecialistController::class, 'showChildProfileSpecialist']); //http://127.0.0.1:8000/api/showchildprofileSpecialist/8/1/B/1
Route::get("showallissues/{emp_id}/{grade}/{class}/{child_id}", [IssueController::class, "showAllIssues"]); //http://127.0.0.1:8000/api/showallissues/8/1/B/1
Route::post("insertissue/{emp_id}/{grade}/{class}/{child_id}", [IssueController::class, "addIssue"]); //http://127.0.0.1:8000/api/insertissue/8/1/B/1
Route::get("showPostforemp/{emp_id}/{grade}/{class}/{child_id}", [EmpSpecialistController::class, "showPostWithReplay"]);//http://127.0.0.1:8000/api/showPostforemp/8/1/B/1
Route::post("insertpost/{emp_id}/{grade}/{class}/{child_id}", [PostController::class, "addPost"]); //http://127.0.0.1:8000/api/insertpost/8/1/B/1
Route::get("showmedicalanaylsis/{emp_id}/{grade}/{class}/{child_id}/{healthdatasetname_id}",[EmpSpecialistController::class,"showHealthMedicalSpecialist"]); //http://127.0.0.1:8000/api/showmedicalanaylsis/8/1/B/1/2
Route::get("showhealthname/{emp_id}/{grade}/{class}/{child_id}",[EmpSpecialistController::class,"showHealthNameSpecialist"]); //http://127.0.0.1:8000/api/showhealthname/8/1/B/1
Route::get("showprsonnalcommet/{emp_id}/{grade}/{class}/{child_id}/{healthdatasetname_id}",[EmpSpecialistController::class,"showHealthCommentSpecialist"]); //http://127.0.0.1:8000/api/showprsonnalcommet/8/1/B/1/2
Route::get("showhealthdata/{emp_id}/{grade}/{class}/{child_id}/{healthdatasetname_id}",[EmpSpecialistController::class,"showHealthDataSpecialist"]); //http://127.0.0.1:8000/api/showhealthdata/8/1/B/1/2
Route::get("showprofile/{emp_id}",[EmployeesProfileController::class,"ShowProfile"]); //http://127.0.0.1:8000/api/showprofile/8
Route::put("editprofile/{emp_id}",[EmployeesProfileController::class,"UpdateProfile"]); //http://127.0.0.1:8000/api/editprofile/8?_method=put

//seller
Route::get("showbandedseller/{emp_id}/{qr_string}",[SelectedfoodController::class,"showBandedFoodSeller"]); //http://127.0.0.1:8000/api/showbanddoc/1/lokmkoilPUXLjrGKzV
Route::get("showallowedseller/{emp_id}/{qr_string}",[SelectedfoodController::class,"showSelectedFoodSeller"]); //http://127.0.0.1:8000/api/showallowedseller/1/lokmkoilPUXLjrGKzV

//make QR_Code for all children
Route::get("createallqr",[ChildController::class,"makeQRAll"]); //http://127.0.0.1:8000/api/createallqr
Route::get("deletemedical/{folderName}", [ChildController::class, "deleteFolder"]);