<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthReport extends Model
{
    use HasFactory;
    protected $fillable = [
        "report",
        "updated_at",
        "created_at",
        "father_id",
        "child_id",
        "emp_id"
    ];
    public function h_reportFather(){
        return $this->belongsTo(Father::class);
    }
    public function h_reportChild(){
        return $this->belongsTo(Child::class);
    }
    public function h_reportEmp(){
        return $this->belongsTo(Employee::class);
    }
}
