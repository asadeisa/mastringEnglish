<?php

namespace App\Models;

use App\Models\Mistake;
use App\Models\Teacher;
use App\Models\Follower;
use App\Models\Progress;
use App\Models\AskAnswer;
use App\Models\ChannelConfig;
use App\Models\Comment;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'teacher',
        "img",
        'is_admin',
        "id"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function teacher()
    {
        return $this->hasMany(Teacher::class ,"user_id");
    }
    public function mistakes()
    {
        return $this->hasMany(Mistake::class ,"user_id");
    }
    public function progress()
    {
        return $this->hasMany(Progress::class ,"user_id");
    }
    public function follower()
    {
        return $this->hasMany(Follower::class ,"user_id");
    }
    public function askAnswer()
    {
        return $this->hasMany(AskAnswer::class ,"user_id");
    }
    public function askQuestion()
    {
        return $this->hasMany(AskQuestion::class ,"user_id");
    }
    public function channelconfig()
    {
        return $this->hasMany(ChannelConfig::class ,"user_id");
    }
    public function comment()
    {
        return $this->hasMany(Comment::class ,"user_id");
    }

}
