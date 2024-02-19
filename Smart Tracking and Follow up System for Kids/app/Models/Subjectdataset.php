<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjectdataset extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'admin_id'
    ];
    public function subjectdatasetAdmin(){
        return $this->belongsTo(Admin::class);
    }
    public function subjectdatasetEmp(){
        return $this->hasMany(Employee::class);
    }
}
