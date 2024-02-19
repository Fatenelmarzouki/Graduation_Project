<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "problem",
        "from",
        "reason",
        "take_action",
        "emp_id",
        "child_id",
        "created_at",
        "updated_at"
    ];
    public function issueChild(){
        return $this->belongsTo(Child::class);
    }
    public function issueEmp(){
        return $this->belongsTo(Employee::class);
    }
}
