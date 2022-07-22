<?php

namespace App\View\Components;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;

class userNav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $TeacherImage;
    public function __construct()
    {
        //
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      
        $this->TeacherImage = 
          Cache::remember('teacherfollower', 400, function () {
            $followTeacher  = Teacher::wherehas("follower",function($q){
                $q->where("user_id","=",auth()->user()->id);
            })->get(['user_id'])->toArray();

            return User::whereIn("id",$followTeacher)->get(['id',"img"])->toArray();
           });

        return view('components.user-nav');
    }
}
