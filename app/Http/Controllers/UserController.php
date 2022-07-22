<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cours;
use App\Models\CoursContent;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


class UserController extends Controller
{
    //
    public $lastprog = null ; 
    public function index($mypath= true)
    {
      $userLevel = auth()->user()->level;
      if(session('myFollowTeacher') != null && $mypath == true)
      {
        return redirect()->route("my-path");

      }
      $lastprog =  DB::table('progress')
      ->where("user_id",'=',auth()->user()->id)
      ->latest('updated_at')
      ->first(['cours_content_id']);
      if($lastprog != null){
        $lastprog = $lastprog->cours_content_id;
      }
      
    
      session(["lastprog"=>$lastprog]);
      // dd($lastprog);
      if($lastprog != null && $mypath == true){
        return redirect()->route("my-path");

      }

      $allCours = Cache::remember('allCours', 400, function () use($userLevel) {
        return Cours::where("level",$userLevel)
                        ->with(
                          [ "coursContent:id,cours_id,grammar_type,voc_type",
                            "coursContent.studentProgress",
                            "teacher.user:id,img,name"
                          ]
                      )
                       
                        ->get()
                          ;

                      });
        // dd($allCours);    
      session(["fromHomePage"=>true]);

      return view("home",compact("allCours"));
    }
    
    public function showCours($id)
    {
            
            session(["active" =>"learn"]);
            // dd($id);
            return view("coursContent",compact("id"));
    }

    public function mypath()
    {
      session(["fromHomePage"=>false]);

      return view("mypath");
    }
    public function mypathFromHeader($id)
    {
      $teacherId = Teacher::where("user_id","=",$id)->first(['id'])->id;
      session(["myFollowTeacher"=>$teacherId]);
      return redirect()->route('my-path');
    }
    public function goHome()
    {
      return $this->index(false);
    }
    public function startBeginener()
    {
      User::where('id','=',auth()->user()->id)->update(['level'=>1]);
      return redirect()->route('home');
    }
    public function gototest(Request $request)
    {
      // dd($request->contentid);
      session(["frommypathPage"=>$request->contentid]);
      // get cours id 
      $CoursContentid = CoursContent::where('id','=',$request->contentid)->first(['cours_id'])->cours_id;
      // dd($CoursContentid);
        return $this->showCours($CoursContentid);
    }
}
