<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;
    protected $fillable = [
        'attendence_date',
        'attendence_status',
        'updated_at',
        'created_at',
        'child_id',
        'emp_id'
    ];

    public function attendenceChild(){
        return $this->belongsTo(Child::class);
    }
    public function attendenceEmp(){
        return $this->belongsTo(Employee::class);
    }
}
