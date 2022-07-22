<?php

namespace App\Http\Livewire;

use App\Models\Mistake;
use Livewire\Component;

class LiveAnalyze extends Component
{
    public $mistake = null ;
    public $allsentenses = [];  
    public function mount()
    {
        $this->mistake = $this->getAllMistake();
    }
    public function render()
    {
        $this-> getsentenses() ;
        return view('livewire.live-analyze');
    }
    public function getAllMistake()
    {
        return Mistake::where("user_id","=",auth()->user()->id)
                        ->with("question",function($q){
                            $q->select(['id','question','true_ans','difficulty','freq','sortabll','translat_sent']);
                        })
                        ->get(['id','question_id'])
                        ->toArray()
                        ;
    }
    public function getsentenses() {
        foreach( $this->mistake as $onemistake)
        {
            $sent = "";
            // dd($onemistake['question']);
            if($onemistake['question']['sortabll'] == 0 &&
               $onemistake['question']['translat_sent'] == 0 )
            {
               $sent =   $onemistake['question']['question'] . ' '.  $onemistake['question']['true_ans'] ; 

            }
            else{
                $sent =   $onemistake['question']['question']  ; 
            }
            array_push($this->allsentenses ,$sent)  ;
        }
   
    }
}
