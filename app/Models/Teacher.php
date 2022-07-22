<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cours;
use App\Models\Follower;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'id',
        'cours_id',
        "rank",
        "glimpse",
    ];
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
    
    public function cours()
    {
        return $this->hasMany(Cours::class ,"teacher_id");
    }
    public function follower()
    {
        return $this->hasMany(Follower::class ,"teacher_id");
    }


}