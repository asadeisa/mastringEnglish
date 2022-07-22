<?php

namespace App\Http\Livewire;

use App\Models\Question;
use App\Models\Test;
use Livewire\Component;

class MainTest extends Component
{
    public $allQustion;
    public $question = null;
    public $option1 = null;
    public $option2 = null;
    public $option3 = null;
    public $option4 = null;
    public $trueAnsower = null;
    public $sortabll = null;
    public $translat_sent = null;
    public $questionId = null;

    public function getQuetion()
    {
       return
        $this->allQustion = Test::where("main_test","=",1)
                            ->with("questions:id,test_id,question,true_ans,option1,option2,option3,option4,sortabll,translat_sent")
                            ->first();
    }
    public function mount()
    {
        $this->getQuetion();

    }
    public function render()
    {
        return view('livewire.main-test');
    }

    public function EditQuestion($id )
    {
       $questionInfo = Question::where("id","=",$id)
                                ->first();
        $this->question   = $questionInfo->question;
        $this->option1   = $questionInfo->option1;
        $this->option2   = $questionInfo->option2;
        $this->option3   = $questionInfo->option3;
        $this->option4   = $questionInfo->option4;
        $this->trueAnsower   = $questionInfo->true_ans;
        $this->sortabll   = $questionInfo->sortabll;
        $this->translat_sent   = $questionInfo->translat_sent;
        $this->questionId = $id;
        $this->dispatchBrowserEvent('editques', ['id' =>$id ]);

    }
    public function save()
    {

       
       if($this->sortabll ==1)
       {
           Question::where("id","=",$this->questionId)
                    ->update([
                        "question" => $this->question,
                    ]);
                 
       }elseif($this->translat_sent ==1)
       {
        Question::where("id","=",$this->questionId)
        ->update([
            "question" => $this->question,
            "true_ans" =>$this->trueAnsower,
        ]);
       }
       else
       {//there the chioes part
        Question::where("id","=",$this->questionId)
        ->update([
            "question" => $this->question,
            "option1"  => $this->option1,
            "option2"  => $this->option2,
            "option3"  => $this->option3,
            "option4"  => $this->option4,
            "true_ans" => $this->trueAnsower,
        ]);
       }

       $this->dispatchBrowserEvent('success');

       $this->getQuetion();
    }
    public function distroyQ($id)
    {
      Question::where("id","=",$id)->delete();
      $this->dispatchBrowserEvent('deletesuccess');
      $this->getQuetion();


    } 
}
