<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\User;
use App\Models\Cours;
use App\Models\Teacher;
use App\Models\Follower;
use App\Models\Question;
use App\Models\CoursContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherController extends Controller
{
    //
    public $allcourses;
    public $teacherId;
    public $courses;
    public $extension;

    public function index()
    {
        $Teacherwithstudnt = Teacher::where("user_id","=",auth()->user()->id)->with("follower",function($q){
            $q->with("user:id,name,img");
        })              
        ->first(['id']);
       
        // dd($Teacherwithstudnt);
        $teacherId = $Teacherwithstudnt->id;
        $allcourses = Cours::where("teacher_id","=",$teacherId)
        ->get();

        return view("teacher.dashboard",compact("Teacherwithstudnt",'allcourses'));
    }

    public function showCourses()
    {
            $teacherId = Teacher::where("user_id","=",auth()->user()->id)              
            ->first()
            ->id;

        $allcourses = Cours::where("teacher_id","=",$teacherId)
                            ->with("coursContent")
                            ->get();
       
        return view("teacher.mycourses",compact(["allcourses","teacherId"]));
    }

    public function newCours(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            
        ]);
        $cours = new Cours ; 
        $cours->level            = $request->level;
        $cours->description      = $request->name;
        $cours->hit_type         = $request->type;
        $cours->teacher_id        = $request->id;
        $cours->save();
        
        Alert::success("the cours add successfly ",'Success Message');
      
        return Redirect::back();

    }
    public function newContent(Request $request)
    {
        
        $validated = $request->validate([
            'text' => 'required|max:455',
            "description" =>'required|max:200',
            
        ]);
        if ($request->file('file') !=null && $request->file('file')->isValid()) {
            //
            $extension = $request->file->extension();
            
            $extlistImage =["webp","svg","png","jpg",
                            "jpeg","jfif","pjpeg","pjp",
                            "gif","avif","apng"
                           ] ;

            $extlistVideo = [ "gifv", "mng", "mov","avi","qt",
                             "mkv","flv", "vob","ogv","ogg","rrc",
                             "webm","wmv", "yuv","rm","asf","amv",
                             "mp4","m4p", "m4v","mpg","mp2","mpeg",
                             "mpe","mpv","m4v","svi","3gp","3g2",
                             "mxf","roq","nsv","flv","f4v","f4p",
                             "f4a","f4b","mod",
                            ] ;

                         $imageRezlat =    array_search($extension,$extlistImage,true);

                         $videoRezalat =    array_search($extension,$extlistVideo,true);

        }else{
            $imageRezlat = false;
            $videoRezalat = false;
        }
      
        if($imageRezlat != false){

            $original_name = strtolower(trim( $request->file('file')->getClientOriginalName()));
            $pathImg = "assets/images/cours/".time().rand(100,999).$original_name;
       
            $request->file('file')->move(public_path('assets/images/cours'), $pathImg);
            $pathVideo = null;

        }elseif($videoRezalat != false){
            $pathVideo = $request->file->store('video');
            $original_name = strtolower(trim( $request->file('file')->getClientOriginalName()));
            $pathVideo = "assets/video/cours/".time().rand(100,999).$original_name;
       
            $request->file('file')->move(public_path('assets/video/cours'), $pathVideo);
            
            $pathImg = null;
        }else{
            $pathImg = null;
            $pathVideo = null;

        }
        
        $content = new CoursContent ;
        $content->cours_id = $request->cours_id;
        if($request->type =="grammar"){
            $content->grammar_type = $request->subject;
            
        }else{
           
            $content->voc_type  = $request->subject;
        } 
        $content->text = $request->text;
        $content->img  = $pathImg;
        $content->video = $pathVideo;
        $content->description = $request->description;
        $content->save();
        Alert::success("the content add successfly ",'Success Message');
      
        return redirect()->back();
    }

    public function getContent($id)
    {
    //    dd($request->teacherid);
      return  $allContent = CoursContent::query()
                      ->where("cours_id","=",$id)
                      ->with("test",function($q){
                          return $q->with("questions");
                      })
                      ->with("cours")
                      ->get();
        
    }
    public function showContent(Request $request)
    {
        
        $allContent = $this->getContent($request->id);
        // dd($allContent);
        return view("teacher.coursContent",compact("allContent"));

    }
    public function student()
    {
        $allStudent = Follower::where("teacher_id","=",Teacher::where("user_id" ,auth()->user()->id )->first(['id'])->id)->with("user")->get(["id" ,"user_id"]); 
        // dd($allStudent);
        return view("teacher.students",compact('allStudent'));
    }
    public function CreateQuestion(Request $request)
    {
        // dd($request->input());
        
       $testid =  Test::where("cours_content_id","=",$request->contentId)->first();
     

        if( $testid == null)
        {
            $test = new Test;
            $test->cours_content_id = $request->contentId  ;
            $test->save();
            $testid = Test::where("cours_content_id","=",$request->contentId)->first();
            
        }
        
        $question = new Question;
        $question->test_id = $testid->id;
        if($request->type_test == "choice")
        {
            $question->question = $request->question;
            $question->option1 = $request->option1;
            $question->option2 = $request->option2;
            $question->option3 = $request->option3;
            $question->option4 = $request->option4;
            $question->true_ans = $request->right_answer;
            
        }
        elseif($request->type_test == "translatsent")
        {
            $question->question = $request->sentences;
            $question->translat_sent = true;
            $question->true_ans = $request->translation;
        }
        elseif($request->type_test == "sortabll")
        {
            $question->question = $request->order;
            $question->sortabll = true;
        }
        $difficulty = 0;
        $freq = 0;
      $question->freq = $freq;
      $question->difficulty = $difficulty;
        $question->save();
        return redirect()->back()->with("success","تم اضافة السؤل  ");
    }

    public function EditContent(Request $request)
    {
       
        if($request->type == "vocabulary")
        {

            CoursContent::where("id","=" ,$request->content_id)->update([
                "description" =>$request->description,
                "text" =>$request->text,
                "voc_type" =>$request->subject,
            ]);
        }
        else{
            CoursContent::where("id","=" ,$request->content_id)->update([
                "description" =>$request->description,
                "text" =>$request->text,
                "grammar_type" =>$request->subject,
            ]);
        }

        if ($request->file('file') !=null && $request->file('file')->isValid()) {
            //
            $extension = $request->file->extension();
            
            $extlistImage =["webp","svg","png","jpg",
                            "jpeg","jfif","pjpeg","pjp",
                            "gif","avif","apng"
                           ] ;

            $extlistVideo = [ "gifv", "mng", "mov","avi","qt",
                             "mkv","flv", "vob","ogv","ogg","rrc",
                             "webm","wmv", "yuv","rm","asf","amv",
                             "mp4","m4p", "m4v","mpg","mp2","mpeg",
                             "mpe","mpv","m4v","svi","3gp","3g2",
                             "mxf","roq","nsv","flv","f4v","f4p",
                             "f4a","f4b","mod",
                            ] ;

                         $imageRezlat = array_search($extension,$extlistImage,true);

                         $videoRezalat =  array_search($extension,$extlistVideo,true);
        }else{
            $imageRezlat = false;
            $videoRezalat = false;
        }
      
        if($imageRezlat != false){

            $original_name = strtolower(trim( $request->file('file')->getClientOriginalName()));
            $pathImg = "assets/images/cours/".time().rand(100,999).$original_name;
       
            $request->file('file')->move(public_path('assets/images/cours'), $pathImg);
            $pathVideo = null;

        }elseif($videoRezalat != false){
            $pathVideo = $request->file->store('video');
            $original_name = strtolower(trim( $request->file('file')->getClientOriginalName()));
            $pathVideo = "assets/video/cours/".time().rand(100,999).$original_name;
       
            $request->file('file')->move(public_path('assets/video/cours'), $pathVideo);
            
            $pathImg = null;
        }else{
            $pathImg = null;
            $pathVideo = null;

        }
        CoursContent::where("id","=" ,$request->content_id)->update([
            "video" =>$pathVideo,
            "img" => $pathImg,
        ]);

        return redirect()->back()->with("success","content change successfuly");



    }
    public function profile()
    {
        $teaherid  = Teacher::where("user_id",auth()->id())->first(['id'])->id ; 
        $totalCours = Cours::where("teacher_id",$teaherid)
                            ->count('teacher_id');
        $totalFollower = Follower::where("teacher_id",$teaherid)
                                 ->count('teacher_id');
                            
        return view("teacher.profile",compact('totalCours',"totalFollower"));
    }

    // go to user 
    public function showMyStudent(Request $request)
    {
        
        $userInfo = User::where("email",$request->email)
        ->with([
            "progress",
            "progress.mistake:id,progress_id",
            "progress.coursContent:id,cours_id,description",
            "progress.coursContent.cours:id,hit_type,description",
            ])
        ->first(["id","img","level","name","created_at"]);
        // dd($userInfo);
        return view("teacher.student-info",compact("userInfo")) ; 
    }
}
