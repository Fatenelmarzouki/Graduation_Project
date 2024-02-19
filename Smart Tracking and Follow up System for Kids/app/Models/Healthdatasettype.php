<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Healthdatasettype extends Model
{
    use HasFactory;
    protected $fillable = [
        'dis_type',
        'created_at',
        'updated_at',
        'admin_id',
        'healthdatasetname_id'
    ];

    protected $hidden = ['pivot'];
    //many to many

    public function healthdatasettypeHealth(){
        return $this->belongsToMany(Health::class, "healthdatasettype_health", "healthdatasettype_id","health_id")->withPivot("healthdatasettype_id","health_id");
    }
    //one to many
    public function healthdatasettypeAdmin(){
        return $this->belongsTo(Admin::class);
    }
    public function healthdatasettypeName(){
        return $this->belongsTo(Healthdatasetname::class);
    }

}
