<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    use HasFactory;
    protected $fillable=[
        "id",
        'banded_food',
        'medicien',
        'medical_analysis',
        'personal_comment',
        'created_at',
        'updated_at',
        'father_id',
        'child_id'
    ];
    protected $hidden = ['pivot'];
    public function healthEmployees(){
        return $this->belongsToMany(Employee::class, "health_emp","health_type", "emp_id");
    }
    public function healthHealthdatasetname(){
        return $this->belongsToMany(Healthdatasetname::class, "healthdatasetname_health","health_id", "healthdatasetname_id")->withPivot("health_id","healthdatasetname_id");
    }
    public function healthHealthdatasettype(){
        return $this->belongsToMany(Healthdatasettype::class, "healthdatasettype_health","health_id", "healthdatasettype_id")->withPivot("health_id","healthdatasettype_id");
    }
    //one to many
    public function healthFather(){
        return $this->belongsTo(Father::class);
    }
    public function healthChild(){
        return $this->belongsTo(Child::class);
    }
}
