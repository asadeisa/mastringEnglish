<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;

class ChannelConfig extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "user_id",
        "channel_key",
        "targetid",
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
       
    }
    public function comment()
    {
        return $this->hasMany(Comment::class ,"channelconfig_id");
    }
 
}
