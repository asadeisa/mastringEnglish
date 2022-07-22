<?php

namespace App\Models;

use App\Models\Test;
use App\Models\Progress;
use App\Models\Cours;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursContent extends Model
{
    use HasFactory;


    protected $fillable = [
        "cours_id",
        "grammar_type",
        "voc_type",
        "img",
        "video",
        "text",
        "description",
    ];

    public function cours()
    {
        return $this->belongsTo(Cours::class,"cours_id");
    }

    public function test()
    {
        return $this->hasMany(Test::class ,"cours_content_id");
    }
    public function progress()
    {
        return $this->hasMany(Progress::class ,"cours_content_id");
    }
    public function studentProgress()
    {
        return $this->progress()->where('user_id','=',auth()->user()->id);
    }
}



