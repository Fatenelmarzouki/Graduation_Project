<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddHealth extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "type",
        "father_id",
        "child_id",
        "health_id",
        "created_at",
        "updated_at"
    ];
    public function addhealthFather(){
        return $this->belongsTo(Father::class);
    }
    public function addhealthChild(){
        return $this->belongsTo(Child::class);
    }
}
