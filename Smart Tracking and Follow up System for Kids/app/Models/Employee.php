<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "email",
        "password",
        "job_title",
        "image",
        "address",
        "phone",
        "access_token",
        "updated_at",
        "created_at",
        "admin_id",
        "subjectdataset_id",
        "activitydataset_id",
    ];
    public function foods(){
        return $this->belongsToMany(Food::class,"emp_food","emp_id","food_id");
    }
    public function childs(){
        return $this->belongsToMany(Child::class,"child_emp","emp_id","child_id");
    }
    public function healths(){
        return $this->belongsToMany(Health::class, "health_emp","emp_id", "health_type");
    }
    public function subjects(){
        return $this->belongsToMany(Subject::class, "subject_emp","emp_id", "subject_id");
    }
    public function selectedfoods(){
        return $this->belongsToMany(Selectedfood::class,"selectedfood_emp","emp_id","selected_food_id");
    }
    public function activities(){
        return $this->belongsToMany(Activity::class,"activity_emp","emp_id","activity_id");
    }
    public function bandedfoods(){
        return $this->belongsToMany(Bandedfood::class,"bandedfood_emp","emp_id","bandedfood_id");
    }
    // one to many
    public function employeeAdmin(){
        return $this->belongsTo(Admin::class);
    }

    public function empActivitydataset(){
        return $this->belongsTo(Activitydataset::class);
    }
    public function empSubjectdataset(){
        return $this->belongsTo(Subjectdataset::class);
    }

    //-----------
    public function empPost(){
        return $this->hasMany(Post::class);
    }
    public function empIssue(){
        return $this->hasMany(Issue::class);
    }
    public function empAttendence(){
        return $this->hasMany(Attendence::class);
    }
    public function emp_S_Report(){
        return $this->hasMany(SubjectReport::class);
    }
    public function emp_H_Report(){
        return $this->hasMany(HealthReport::class);
    }

}
