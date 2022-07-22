<?php

namespace App\Models;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "teacher_id",
        "id",
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class,"teacher_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
       
    }
}
