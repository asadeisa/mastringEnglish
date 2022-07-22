<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Cours;
use App\Models\Follower;
use App\Models\Teacher;
use Livewire\Component;

class MyPath extends Component
{
    public $allCours = null;

    public function render()
    {
        return view('livewire.my-path');
    }
    public function mount()
    {
        $this->getCourses();
    }
    public function getCourses()
    {
      
        if(session("lastprog") != null)
        {

            $teacherId =  Cours::whereHas("coursContent",function($q){
                 $q->where("id","=",session("lastprog"));
             })->first(['teacher_id'])->teacher_id;
             // dd($teacherId);
             if(session("myFollowTeacher") == null ){
                 $teacherId =  $teacherId;
             }else{
                 $teacherId = session("myFollowTeacher");
          
     
             }
        }else{
           $idcollection =  Follower::where("user_id",'=',auth()->user()->id)->first(['teacher_id']);
           if($idcollection != null)
           {
              $teacherId = $idcollection->teacher_id; 
           }
        }
        $this->allCours =
         Cours::where("teacher_id","=", $teacherId )
                ->where("level","=",auth()->user()->level)
                ->with(
                    [
                        "coursContent:id,cours_id,grammar_type,voc_type",
                        "coursContent.studentProgress"
                    ]
                    )
                ->get()
                ->toArray();
                // dd($this->allCours );
    }

    public function  getNextLevel()
    {
        $totleComplete = 0 ;
        foreach( $this->allCours as $cours)
        {
            foreach( $cours['cours_content'] as $content)
            {
                if($content['student_progress'] != null)
                {

                    $totleComplete +=    $content['student_progress'][0]['complet'];
                }
            }
            $totleComplete = $totleComplete/ count($cours['cours_content'] );
        }
        // go next level 
        if($totleComplete == 100){
            User::where("id",'=',auth()->user()->id)->update(["level"=>auth()->user()->level +1]);
            
            $this->getCourses();

        }else{
          $this->dispatchBrowserEvent('finesh-content');

        }
    }
}
