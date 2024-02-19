<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{

    use HasFactory;
    protected $fillable = [
        "name",
        "age",
        "grade",
        "gender",
        "health_condition",
        "image",
        "height",
        "weight",
        "blood",
        "class",
        "created_at",
        "updated_at",
        "admin_id",
        "father_id",
        "activitydataset_id",
        "qr_code",
        "child_code",
        "qr_string"
    ];
    // one to one
    public function childActivity(){
        return $this->hasOne(Activity::class);
    }
    //many to many
    public function employeesChild(){
        return $this->belongsToMany(Employee::class,"child_emp","child_id","emp_id");
    }
    public function childSelectedfood(){
        return $this->belongsToMany(Selectedfood::class,"child_selectedfood","child_id","selected_food_id");
    }
    public function subjectChild(){
        return $this->belongsToMany(Subject::class, "child_subject","child_id","subject_id");
    }

    public function childBandedfood(){
        return $this->belongsToMany(Bandedfood::class,"bandedfood_child","child_id","bandedfood_id")->withPivot("child_id","bandedfood_id");
    }
    //one to many
    public function childAdmin(){
        return $this->belongsTo(Admin::class);
    }
    public function childFather(){
        return $this->belongsTo(Father::class);
    }
    public function childActivitydataset(){
        return $this->belongsTo(Activitydataset::class,"activitydataset_id","id");
    }
    //------
    public function childHealth(){
        return $this->hasMany(Health::class);
    }
    public function childIssue(){
        return $this->hasMany(Issue::class);
    }
    public function childPost(){
        return $this->hasMany(Post::class);
    }
    public function childAttendence(){
        return $this->hasMany(Attendence::class);
    }
    public function child_S_Report(){
        return $this->hasMany(SubjectReport::class);
    }
    public function child_H_Report(){
        return $this->hasMany(HealthReport::class);
    }
    public function childAddhealth(){
        return $this->hasMany(AddHealth::class);
    }
}
