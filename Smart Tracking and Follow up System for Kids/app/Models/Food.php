<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $fillable=[
        "name",
        "calories",
        "created_at",
        "updated_at",
        "admin_id",
    ];
    //many to many
    public function employeesFood(){
        return $this->belongsToMany(Employee::class,"emp_food","food_id","emp_id");
    }
    public function foodFather(){
        return $this->belongsToMany(Father::class,"father_food","food_id","father_id");
    }
    //one to many
    public function foodAdmin(){
        return $this->belongsTo(Admin::class);
    }
    //many to one
    public function foodSelectedfood(){
        return $this->hasMany(Selectedfood::class,"food_id","id");
    }
    public function foodBandedfood(){
        return $this->hasMany(Bandedfood::class,"food_id","id");
    }


}
