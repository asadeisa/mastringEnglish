<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ChannelConfig;

class Comment extends Model
{
    use HasFactory;


    protected $fillable = [
        "user_id",
        "channelconfig_id",
        "body",
        'is_readed',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
       
    }
    public function channelconfig()
    {
        return $this->belongsTo(ChannelConfig::class,"channelconfig_id");
       
    }
}
