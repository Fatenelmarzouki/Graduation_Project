<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectReport extends Model
{
    use HasFactory;
    protected $fillable = [
        "report",
        "updated_at",
        "created_at",
        "father_id",
        "child_id",
        "emp_id",
        "subjectdataset_id",
        "activitydataset_id"
    ];
    public function s_reportFather(){
        return $this->belongsTo(Father::class);
    }
    public function s_reportChild(){
        return $this->belongsTo(Child::class);
    }
    public function s_reportEmp(){
        return $this->belongsTo(Employee::class);
    }
}
