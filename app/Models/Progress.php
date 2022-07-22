<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CoursContent;
use App\Models\Mistake;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "cours_content_id",
        "complet",
        "id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
       
    }
    public function coursContent()
    {
        return $this->belongsTo(CoursContent::class,"cours_content_id");
       
    }
    public function mistake()
    {
        return $this->hasMany(Mistake::class ,"progress_id");
    }
}
