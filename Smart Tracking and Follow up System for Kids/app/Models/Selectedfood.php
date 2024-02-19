<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selectedfood extends Model
{
    use HasFactory;
    protected $fillable = [
        'count',
        'updated_at',
        'created_at',
        "food_id"
    ];
    public function employeesSelectedfood(){
        return $this->belongsToMany(Employee::class,"selectedfood_emp","selected_food_id","emp_id");
    }
    public function selectedfoodChild(){
        return $this->belongsToMany(Child::class,"child_selectedfood","selected_food_id","child_id");
    }
    public function selectedfoodFather(){
        return $this->belongsToMany(Father::class,"selectedfood_father","selected_food_id","father_id");
    }
    public function selectedfoodFood(){
        return $this->belongsTo(Food::class,"food_id","id");
    }
}
