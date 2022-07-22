<?php

namespace App\Models;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mistake extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "question_id",
        "progress_id",
        "id",
    ];
    public function question()
    {
        return $this->belongsTo(Question::class,"question_id");
       
    }
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
       
    }
    public function progress()
    {
        return $this->belongsTo(Progress::class,"progress_id");
       
    }
}
