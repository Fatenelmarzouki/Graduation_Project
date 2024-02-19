<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Admin extends Model implements Authenticatable
{
    use HasFactory;
    protected $table = 'admins';
    protected $guarded = array();
    protected $fillable = [
        'email',
        'password',
        'updated_at',
        'created_at'
    ];
    
    public function adminHealtdatasetnames(){
        return $this->hasMany(Healthdatasetname::class);
    }
    public function adminHealtdatasettypes(){
        return $this->hasMany(Healthdatasettype::class);
    }
    public function adminFood(){
        return $this->hasMany(Food::class);
    }
    public function adminEmployee(){
        return $this->hasMany(Employee::class);
    }
    public function adminFather(){
        return $this->hasMany(Father::class);
    }
    public function adminChild(){
        return $this->hasMany(Child::class);
    }
    public function adminSubjectdataset(){
        return $this->hasMany(Subjectdataset::class);
    }
    public function adminActivitydataset(){
        return $this->hasMany(Activitydataset::class);
    }
    
    //make the Auth
    public function getAuthIdentifierName(){
        return 'email';
    }

    public function getAuthIdentifier(){
        return $this->email;
    }

    public function getAuthPassword(){
        return $this->password;
    }

    public function getRememberToken(){
        return $this->remember_token;
    }

    public function setRememberToken($value){
        $this->remember_token = $value;
    }

    public function getRememberTokenName(){
        return 'remember_token';
    }

}
