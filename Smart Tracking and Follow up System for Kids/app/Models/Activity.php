<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'mark',
        'behavior',
        'team_work',
        'performance_evaluation',
        'child_id',
        'updated_at',
        'created_at'
    ];
    // one to one 
    public function activityChild(){
        return $this->belongsTo(Child::class,"child_id","id");
    }
    //many to many
    public function activityEmployees(){
        return $this->belongsToMany(Employee::class,"activity_emp","activity_id","emp_id");
    }
}