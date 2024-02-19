<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bandedfood extends Model
{
    use HasFactory;
    protected $fillable=[
        "food_id",
        "created_at",
        "updated_at",
    ];
    public function bandedfoodFood(){
        return $this->belongsTo(Food::class,"food_id","id");
    }

    public function bandedfoodEmp(){
        return $this->belongsToMany(Employee::class,"bandedfood_emp","bandedfood_id","emp_id");
    }

    public function bandedfoodChild(){
        return $this->belongsToMany(Child::class,"bandedfood_child","bandedfood_id","child_id")->withPivot("child_id","bandedfood_id");
    }

}
