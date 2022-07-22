<?php

namespace App\Http\Livewire;

use App\Models\Cours;
use App\Models\CoursContent;
use Livewire\Component;

class AdminCourses extends Component
{
    public $AllCoures = null;
    public $showCoures = true;
    public $coursContent =null; 
    public $title = null;
    public function render()
    {
        return view('livewire.admin-courses');
    }
    public function getAllCourses()
    {
      return
       Cours::query()
            // ->when("cours.id","!=",null)
            ->join("teachers","teachers.id","=","cours.teacher_id")
            ->join("users","users.id","=","teachers.user_id")
            ->with("coursContent:id,cours_id,grammar_type,voc_type")
            ->get(["cours.rank as crank","cours.id", "cours.level",
                   "cours.hit_type","cours.description",
                   "teachers.rank as t_rank",
                  "users.id as usersId","users.name as UName"
                ]);
          
    }

    public function mount()
    {
      $this->AllCoures = $this->getAllCourses();
    }
    public function showCoursContent($id,$title)
    {
      
      $this->title = $title;
      // dd($title);
      $this->showCoures = false;

      $this->coursContent = 
      CoursContent::where("cours_id","=",$id)
                        ->with("test",function($q){
                          $q->with("questions");
                        })
                       
                        ->get();
                        // dd($this->coursContent);
    }
    public function goback()
    {
      $this->title = null;
 
      $this->showCoures = true;
      $this->AllCoures = $this->getAllCourses();

    }
}
