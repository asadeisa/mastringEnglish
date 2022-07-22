<?php

namespace App\Models;

use App\Models\User;
use App\Models\AskQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AskAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'id',
        'ask_id',
        "ans",
        "voice",
    ];
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
    public function askQuestion()
    {
        return $this->belongsTo(AskQuestion::class,"ask_id");
    }
}
