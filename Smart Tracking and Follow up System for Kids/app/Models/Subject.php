<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'mark',
        'behavior',
        'activity',
        'interact',
        'team_work',
        'created_at',
        'updated_at',
        'father_id',
        'subjectdataset_id',
        'child_id'
    ];
    public function employeesSubject(){
        return $this->belongsToMany(Employee::class, "subject_emp","subject_id","emp_id");
    }
    public function childSubject(){
        return $this->belongsToMany(Child::class, "child_subject","subject_id","child_id");
    }
    //one to many 
    public function subjectFather(){
        return $this->belongsTo(Father::class);
    }
}
