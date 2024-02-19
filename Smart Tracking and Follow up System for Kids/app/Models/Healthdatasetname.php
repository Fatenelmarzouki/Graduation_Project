<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Healthdatasetname extends Model
{
    use HasFactory;
    protected $fillable = [
        'dis_name',
        'created_at',
        'updated_at',
        'admin_id'
    ];
    //many to many
    public function healthdatasetnameHealth(){
        return $this->belongsToMany(Health::class, "healthdatasetname_health","healthdatasetname_id","health_id")->withPivot("health_id");
    }
    //one to many
    public function healthdatasetnameAdmin(){
        return $this->belongsTo(Admin::class);
    }
    //---------
    public function healthdatasetnameType(){
        return $this->hasMany(Healthdatasettype::class);
    }

}
