<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitydataset extends Model
{
    use HasFactory;
    protected $fillable=[
        "name",
        "created_at",
        "updated_at",
        "admin_id"
    ];


    public function activitydatasetEmp(){
        return $this->hasMany(Employee::class);
    }
    public function activitydatasetChild(){
        return $this->hasMany(Child::class);
    }
    //---------=============----------
    public function activitydatasetAdmin(){
        return $this->belongsTo(Admin::class,"admin_id","id");
    }

}
