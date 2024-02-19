<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "problem",
        "take_action",
        "requirements",
        "father_reply",
        "created_at",
        "updated_at",
        "emp_id",
        "child_id",
        "father_id",
    ];
    public function postChild(){
        return $this->belongsTo(Child::class);
    }
    public function postFather(){
        return $this->belongsTo(Father::class);
    }
    public function postEmp(){
        return $this->belongsTo(Employee::class);
    }
}
