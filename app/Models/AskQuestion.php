<?php

namespace App\Models;

use App\Models\User;
use App\Models\AskAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AskQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'id',
        'a_question',
        "a_question_type",
        "a_voice",
        'a_sentenses',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
    public function askAnswer()
    {
        return $this->hasMany(AskAnswer::class ,"ask_id");
    }
}
