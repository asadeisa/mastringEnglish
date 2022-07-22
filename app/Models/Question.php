<?php

namespace App\Models;

use App\Models\Test;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        "test_id",
        "question",
        "true_ans",
        "option1",
        "option2",
        "option3",
        "option4",
        "sortabll",
        "translat_sent",
        "difficulty",
        "freq",
    ];

    public function test()
    {
        return $this->belongsTo(Test::class,"test_id");
       
    }
    public function mistakes()
    {
        return $this->hasMany(Mistake::class ,"question_id");
    }

}
