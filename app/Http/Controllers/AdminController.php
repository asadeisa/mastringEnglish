<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\User;
use App\Models\Cours;
use App\Models\CoursContent;
use App\Models\Teacher;
use App\Models\Question;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $Teacherjoiningreq = Teacher::where("status",0)->with("user:id,name,email,img")->get(["id",'user_id']);
        // dd($Teacherjoiningreq);
        return view("admin.dashboard",compact('Teacherjoiningreq'));
    }
    public function showUser()
    {
        $alluser = User::where("teacher",0)->where("is_admin",0)->get(["name","email","level","img","created_at"]) ; 
        return view("admin.users",compact("alluser"));
    }
    public function mainTest()
    {
        return view("admin.main-test");
    }
    public function createNewTest(Request $request)
    {

       
        if($request->maintest == 1)
        {
          $mainTest =  Test::where("main_test","=",1)->first();

          if( $mainTest == null)
          {
            $coursid = Cours::where("teacher_id",auth()->id())->first(["id"]) ; 
            if($coursid == null )
            {

                $cours = new Cours ; 
                
                $cours->teacher_id = auth()->id() ; 
                $cours->level = 5 ; 
                $cours->hit_type = "main-test" ; 
                $cours->description = "main-test" ; 
                $cours->coursContent->description = "main-test" ;
                $cours->save(); 
               $coursid = Cours::where("teacher_id",auth()->id())->first(["id"]) ; 
               
            }else{
              $coursid   =  $coursid->id ; 

            }
            $coursContentid =CoursContent::first(['id'])->id ;  
           
            $test = new Test;
            $test->main_test = 1;
            $test->cours_content_id = $coursContentid;
            $test->save(); 
            $mainTestId =  Test::where("main_test","=",1)->first()->id;
          }
          else{
              
            $mainTestId =  $mainTest->id;
          }
          $question = new Question;
          $question->test_id = $mainTestId;
          if($request->type_test == "choice")
          {
              $question->question = $request->question;
              $question->option1 = $request->option1;
              $question->option2 = $request->option2;
              $question->option3 = $request->option3;
              $question->option4 = $request->option4;
              $question->true_ans =$request->right_answer; 
            //   for the classefy word
              $totelQuestionWord = $request->question . $request->right_answer; 
          }
          elseif($request->type_test == "translatsent")
          {
              $question->question = $request->sentences;
              $question->translat_sent = true;
              $question->true_ans = $request->translation;
              $totelQuestionWord = $request->sentences ; 
          }
          elseif($request->type_test == "sortabll")
          {
              $question->question = $request->order;
              $question->sortabll = true;
              $totelQuestionWord = $request->order ; 
  
          }
          $difficulty = 0;
          $freq = 0;
          $jsonFile =   file_get_contents(asset("json/allWords-list from acdamic web.json"));
          $totWords = json_decode($jsonFile, true);
        $sentasWord =  explode(" ",$totelQuestionWord);
        foreach($sentasWord as $oneWord)
        {
            foreach($totWords as $jsonword)
            {
                
                if($jsonword["word"]=== $oneWord )
                {
                    $difficulty += $jsonword["difficulty"]; 
                    $freq +=   $jsonword["freq"] ;
                    break;
                }
            }

        }
           
        if($difficulty == 0)
        {
            $difficulty  =  count($sentasWord)/2;
        }
        if($freq == 0)
        {
            $freq  =  count($sentasWord)/3;
        }

        $difficulty  = round($difficulty/count($sentasWord),2)  ;
        $freq  = round( $freq/count($sentasWord),2) ;
        
         
          $question->freq = $freq;
          $question->difficulty = $difficulty;
          $question->save();
          return redirect()->back()->with("success","تم اضافة السؤل  ");
          


        }

    }

    public function showCoures()
    {
        return view("admin.courses");
    }
    public function showTecher()
    {
        return view("admin.teacher");
    }


    public function profile()
    {
        return view("admin.profile");
    }
    public function membershep(Request $request)
    {
        // dd($request->teacher_id);
        Teacher::where("id",$request->teacher_id)->update([
            'status' => 1
        ]);
        return redirect()->back() ; 
    }
    public function deleteStudent(Request $request)
    {
        // dd($request->teacher_id);
        User::where("id",$request->user_id)->delete();
        return redirect()->back() ; 
    }
}
