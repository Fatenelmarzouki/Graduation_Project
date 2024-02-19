<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "heart_rate",
        "updated_at",
        "created_at",
        "child_id"
    ];
}
