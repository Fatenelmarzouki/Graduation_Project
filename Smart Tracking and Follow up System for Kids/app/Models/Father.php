<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Father extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "email",
        "password",
        "address",
        "phone",
        "gender", 
        "image",
        "status",
        "created_at",
        "updated_at",
        "access_token",
        "username",
        "admin_id",
    ];
    public function fatherSelectedfood(){
        return $this->belongsToMany(Selectedfood::class,"selectedfood_father","father_id","selected_food_id");
    }

    public function fatherFood(){
        return $this->belongsToMany(Food::class,"father_food","father_id","food_id");
    }
    //one to many
    public function fatherAdmin(){
        return $this->belongsTo(Admin::class);
    }

    //--------------
    public function fatherSubject(){
        return $this->hasMany(Subject::class);
    }
    public function fatherHealth(){
        return $this->hasMany(Health::class);
    }
    public function fatherChild(){
        return $this->hasMany(Child::class);
    }
    public function fatherPost(){
        return $this->hasMany(Post::class);
    }
    public function father_S_Report(){
        return $this->hasMany(SubjectReport::class);
    }
    public function father_H_Report(){
        return $this->hasMany(HealthReport::class);
    }
    public function fatherAddhealth(){
        return $this->hasMany(AddHealth::class);
    }
}