<?php

namespace App\Models;

use App\Models\Question;
use App\Models\CoursContent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        "cours_content_id",
        "main_test",
    ];

    public function coursContent()
    {
        return $this->belongsTo(CoursContent::class,"cours_content_id");
       
    }

    public function questions()
    {
        return $this->hasMany(Question::class ,"test_id");
    }
}
