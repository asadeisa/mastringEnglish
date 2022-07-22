<?php

namespace App\Http\Livewire;

use App\Models\AskAnswer;
use App\Models\AskQuestion;
use Livewire\Component;

class AskeQuestion extends Component
{
    public $datashow =  "all" ; 
    public $allcontent = null;
    public $sentence = "";
    public $secondsentence = null;
    public $voice = null;
    public $answertext = [];
    public $voiceans = '';
    public function mount()
    {
      $this->allcontent =  $this->getquestionAndanswer();
    //   dd($this->allcontent );
    }

    public function updated()
    {
        // dd( $this->answertext[0][0],$this->answertext[0][1]);
        
        if( count($this->answertext )!= 0  )
        {
            

            // dd($this->answertext);
            $askAnswer = new AskAnswer ;
            $askAnswer->user_id  = auth()->user()->id;
            $askAnswer->ask_id  =$this->answertext[0][0];
            $askAnswer->ans  =$this->answertext[0][1];
            // if($this->voiceans != '')
            // {

            // }
            
            $askAnswer->save();
          
          $this->dispatchBrowserEvent('save-ans');

        }
        $this->allcontent = null ; 
        $this->allcontent =  $this->getquestionAndanswer();

    }
    public function render()
    {
        unset($this->answertext);
        $this->answertext = [];
        return view('livewire.aske-question');
    }

    public function getquestionAndanswer()
    {
        if($this->datashow == "all")
        {
            return AskQuestion::
                    with([ "user:id,name,img",
                           "askAnswer",
                           "askAnswer.user:id,name,img,teacher"
                         ]
                        )
                    ->get()
                    ->toArray();
        }elseif($this->datashow == "myquestion"){

            return AskQuestion::
                    where('user_id','=',auth()->user()->id)
                    -> with([ "user:id,name,img",
                            "askAnswer",
                            "askAnswer.user:id,name,img,teacher"
                        ])
                    ->get()
                    ->toArray();
        }

        else{
            return AskQuestion::
                    where('a_question_type','=',$this->datashow)->with([ "user:id,name,img",
                            "askAnswer",
                            "askAnswer.user:id,name,img,teacher"
                        ]
                        )
                    ->get()
                    ->toArray();
        }

    }
    public function saveQuestion()
    {
        $Askquestion = new AskQuestion ;
            // dd($this->sentence);
            $Askquestion->a_question = $this->sentence; 
            $Askquestion->user_id = auth()->user()->id;
            
        $Askquestion->a_sentenses = $this->secondsentence;

        $Askquestion->a_voice =$this->voice ;
            
        if($this->datashow =='natural'){
            $Askquestion->a_question_type ='natural' ;

        }elseif($this->datashow =='meaning'){
            $Askquestion->a_question_type ='meaning' ;

        }elseif($this->datashow =='isay'){
            $Askquestion->a_question_type ='isay' ;

        }else{
            $Askquestion->a_question_type ='pronounce' ;

        }
        $Askquestion->save();
             $this->allcontent = null;
     $this->allcontent =  $this->getquestionAndanswer();
      $this->dispatchBrowserEvent('save-question');
     $this->dispatchBrowserEvent('save-ans');


    }
    public function deleteComment($id)
    {
     
     AskAnswer::where('id','=',$id)->delete();
     $this->dispatchBrowserEvent('save-ans');
    //  $this->allcontent = null;
    //  $this->allcontent =  $this->getquestionAndanswer();


    }
}
