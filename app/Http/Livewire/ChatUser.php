<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ChannelConfig;
use Illuminate\Support\Facades\DB;

class ChatUser extends Component
{
    public $userInfo ; 
    public $messageNam = null;
    public function mount()
    {
        $this->getUnrededMessage();
    }

    public function getUnrededMessage(){
    //    $unrcomment = $this->userInfo->channelconfig->comment;
        // dd($this->userInfo->toArray()) ;
        $this->userInfo = $this->userInfo->toArray() ; 
        // dd(count($this->userInfo->toArray()) );
        $unrcomment = null ;  
         if( count($this->userInfo['channelconfig']) != 0  )
         {
          
            if( count($this->userInfo['channelconfig'][0]["comment"]) != 0)
            {
                
                $unrcomment = $this->userInfo['channelconfig'][0]["comment"]; 
            }

         } 
    //    ChannelConfig::where(
    //        [ "user_id" => auth()->user()->id,  
    //         "targetid" => $this->userInfo->id] 
    //        )->orWhere(function($q){
    //         $q->where(    
    //             ["user_id" =>  $this->userInfo->id,
    //             "targetid" => auth()->user()->id ]) ;
    //        }
    //        )
    //        ->with([
    //         "comment" => function($q){
    //            $q
    //             ->where("user_id",$this->userInfo->id)
    //             ->where("is_readed",0);
    //            }
    //        ])->first(['id']);
           
           if($unrcomment != null ){

               $this->messageNam  = count($unrcomment) ;
           }
           
        // dd($this->messageNam );
    }
    public function render()
    {
        return view('livewire.chat-user');
    }
    public function setthischat()
    {
        
        $this->emitUp('trrigerTargetid', $this->userInfo['id']);
    }
}
