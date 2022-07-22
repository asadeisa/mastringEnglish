<?php

namespace App\Http\Livewire;

use App\Models\Test;
use App\Models\Mistake;
use App\Models\User;
use Livewire\Component;
use \Statickidz\GoogleTranslate;

class LevelDecated extends Component
{
  public $AllTest = null;
  public $studentAnswers = [];
  public $countTest = 0;
  public $nextGroupeQuestion = false;
  public $levelinterface = 'level one';

  public function getAllTest($level = "b", $offset = 0)
  {


    session(['curentlevel' => $level]);
    $freq = null;
    $topf  = null;
    $mind = null;
    $difficulty = null;
    if ($level == "b") {
      $freq = 0.90;
      $topf  = 1;
      $mind = 0;
      $difficulty = 0.30;
      $this->levelinterface = 'beginner';
    } elseif ($level == "intr1") {
      $freq = 0.80;
      $topf  = 1;
      $mind = 0.31;
      $difficulty = 0.45;
      $this->levelinterface = 'intermediate 1';

    } elseif ($level == "intr2") {
      $freq = 0.60;
      $topf  = 1;
      $mind = 0.46;
      $difficulty = 0.6;
      $this->levelinterface = 'intermediate 2';

    } elseif ($level == "expert") {
      $freq = 0.0;
      $topf  = 1;
      $mind = 0.61;
      $difficulty = 1;
      $this->levelinterface = 'expert';

    }
    return Test::where("main_test",1)
      ->with("questions", function ($q) use ($freq, $difficulty, $topf, $mind, $offset) {
        return   $q->whereBetween("freq", [$freq, $topf])
          ->whereBetween("difficulty", [$mind, $difficulty])
          ->offset($offset)
          ->take(5);
      })->first()->toArray();
  }

  public function mount()
  {
    $this->AllTest = $this->getAllTest();
  }

  public function render()
  {
    return view('livewire.level-decated');
  }

  public function updated()

  {
    $this->studentAnswerF();
  }

  public function studentAnswerF()
  {
    if ($this->studentAnswers != null) {

      $trueAnswer = [];
      foreach ($this->AllTest['questions'] as $keya=> $question) {
        if ($question['sortabll'] == 1) {
  
          array_push($trueAnswer, $question['question']);
        }

        // if you wont to retun translat function to work
        
        // elseif($question['translat_sent'] == 1)
        // {
        //     if($this->getTranslation($this->studentAnswers[$keya] ,"ar","en") == $question['true_ans'])
        //     {
        //        array_push($trueAnswer, $this->studentAnswers[$keya]);
              
        //     }
        
        //     else
        //     {
        //     array_push($trueAnswer, $question['true_ans']);
    
        //     }
        // }
        else {
  
          array_push($trueAnswer, $question['true_ans']);
        }
      }
  
      // dd($trueAnswer);
      $TestMestakeResult = array_diff($trueAnswer, $this->studentAnswers);
      // dd($Testresult);
      $idOFError = []; // id of flase answoer

      foreach ($TestMestakeResult as $key => $oneresult) {

        // array_push($idOFError,$this->AllTest['questions'][$key]["id"]);
        array_push(
          $idOFError,
          [
            "question_id" => $this->AllTest['questions'][$key]["id"],
            "user_id"  =>auth()->user()->id,
           
          ]
        );
      }
     
      // insert the Error location in mistakes table ; 
      Mistake::insert($idOFError);
    

      if (count($idOFError) > 3) {
        // go home ; 
        $this->insertLevel($this->ConvertLevelTowNumper()); 
        return redirect('home');
      } elseif (count($idOFError) == 3) {
        $this->countTest++;
        if ($this->countTest == 2) {
         
          $this->insertLevel($this->ConvertLevelTowNumper()); 

          return redirect('home');
        } else {

          // fitsh same level of questions ;
          
          $this->AllTest = $this->getAllTest(session('curentlevel'),5);
          $this->studentAnswers = [];
         $this->nextGroupeQuestion == true;

         
        }
      } else {
        // fitsh level obove ;
      

        $nextLevel  = $this->getnextLevel();
        
        if ($nextLevel == "end") {
          $this->insertLevel($this->ConvertLevelTowNumper()); 

          // go home
          return redirect('home');
        } else {
         $this->AllTest =  $this->getAllTest($nextLevel);
         
         $this->studentAnswers = [];
         $this->nextGroupeQuestion == true;

        }
      }
    }
    else{
      // the answoer is empty ; 
    }
  }

  public function getnextLevel()
  {
    $curentlevel = session('curentlevel');
    if ($curentlevel == "b") {
      return "intr1";
    } elseif ($curentlevel == "intr1") {
      return "intr2";
    } elseif ($curentlevel == "intr2") {
      return "expert";
    } else {
      return "end";
    }
  }
  public function ConvertLevelTowNumper()
  {
    $curentlevel = session('curentlevel');
    if ($curentlevel == "b") {
      return 1;
    } elseif ($curentlevel == "intr1") {
      return 2;
    } elseif ($curentlevel == "intr2") {
      return 3;
    } else {
      return 4;
    }
  }
  public function insertLevel($studentLevel)
  {
    User::where("id",auth()->user()->id)->update([
      "level"  =>$studentLevel
    ]);
  }

  // public function getTranslation($text,$source='en',$target ='ar')
  // {
  //   // defult trans from en => ar ; 
  //   $trans = new GoogleTranslate();
  //   return   $trans->translate($source, $target, $text);

  // }

    public function InteruptTest()
    {
      // dd($this->ConvertLevelTowNumper());
      User::where("id",auth()->user()->id)->update([
        "level"  =>$this->ConvertLevelTowNumper()
      ]);
      return redirect('home');

    }

}
