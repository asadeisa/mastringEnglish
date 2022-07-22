<?php

namespace App\Models;

use App\Models\Teacher;
use App\Models\CoursContent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        "teacher_id",
        "level",
        "hit_type",
        "description",
        "rank",
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class,"teacher_id");
    }

    public function coursContent()
    {
        return $this->hasMany(CoursContent::class ,"cours_id");
    }
}
