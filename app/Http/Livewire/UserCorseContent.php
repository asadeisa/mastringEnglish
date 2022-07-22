<?php

namespace App\Http\Livewire;

use App\Models\Cours;
use App\Models\Follower;
use App\Models\Mistake;
use App\Models\Progress;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;


class UserCorseContent extends Component
{
  public $contentid; 
  public $coursContent;
  public $keyConntent =0;
  public $showfollowMesseg = false;
  public $isFollower  =null;
  public $treggerFowllowQ = false ; 
    public function render()
    {
      
        return view('livewire.user-corse-content');
    }
    public function updated()
    {
      if($this->treggerFowllowQ == true)
      {
        
      return redirect()->route("my-path");

      }
    }
    public function mount()
    {

      if (Cache::has('coursContent')) {
        //
        if(session("contentid") != $this->contentid )
        {

          Cache::forget('coursContent');
        }
        
      }
      $this->showCours();
      $this->isFollower = $this->isFollowing();
      if($this->isFollower  != null)
      {
        $this->showfollowMesseg  =true;

      }
    }

    public function isFollowing(){
     
      return Follower::where(["user_id" =>auth()->user()->id,
                              "teacher_id" => $this->coursContent['teacher']['id']])->first(['id']); 
    }

    public function showCours()
    {
      
      // you have to modfy id from my-path page ;
     if(session("frommypathPage") != null && session('fromHomePage') == false ){
      // dd($this->contentid);
      $this->coursContent =
                  Cours::where("id",$this->contentid)
                    ->with("coursContent",function($q){
                      $q->where("id","=",session("frommypathPage"))
                      ->with([
                               "test.questions",
                                "progress"
                             ]);
                    })
                    ->with(
                      [
                        "teacher:id,user_id,rank",
                        "teacher.user:id,name,email,img"
                      ]
                      )
                    ->first()
                    ->toArray() 
                    ;
                  

     } else{

       session(['contentid' =>$this->contentid ]);
       
       $this->coursContent= Cache::remember('coursContent', 400, function () {
         return  Cours::where("id","=",$this->contentid)
                   ->with(["coursContent",
                          "coursContent.test.questions:id,test_id,question,true_ans,option1,option2,option3,option4,sortabll,translat_sent","coursContent.progress",
                          "teacher:id,user_id,rank",
                          "teacher.user:id,name,email,img"
                          ])
                          ->first()
                          ->toArray() ;
        });
     }
      
  
    }
    public function EndTasek($ErrorQueue,$contentid,$maxCountQustion)
    {

      $progress = new Progress;
      $progress->user_id = auth()->user()->id ;
      $progress->cours_content_id = $contentid ;
      $progress->complet =round((1-(count($ErrorQueue) / $maxCountQustion)),2) *100  ;
      $progress->save();

      foreach($ErrorQueue as $onemisstack){
          $mistake = new  Mistake; 
             
          $mistake->question_id = $onemisstack;
          $mistake->user_id = auth()->user()->id;
          $mistake->progress_id =  $progress->id;
          $mistake->save();
      
      }
      $this->dispatchBrowserEvent('finish-qustion');

        

    }
    public function getNewCours()
    {
      return redirect("home");
    }
    public function closeQustion()
    {
      $this->dispatchBrowserEvent('finish-qustion');

    }
    public function followTeacher()
    {
      
      $followr = new Follower ;
      $followr->user_id  = auth()->user()->id ; 
      $followr->teacher_id  =$this->coursContent['teacher']['id'] ;
      $followr->save();
        Cache::forget('teacherfollower');

      $this->showfollowMesseg = true ; 
    }
    public function gotoTeacherCourses()
    {
      session(['myFollowTeacher' =>$this->coursContent['teacher']['id'] ]);
      return redirect()->route("my-path");


    }
}
