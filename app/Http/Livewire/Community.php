<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Comment;
use Livewire\Component;
use App\Events\ChatChennal;
use App\Events\RejectOffer;
use App\Events\StreamOffer;
use App\Events\StreamAnswer;
use App\Events\websocketTest;
use App\Models\ChannelConfig;
use App\Events\EndRTCConnction;
use App\Events\OrderShipmentStatusUpdated;

class Community extends Component
{
    public $alluser = null ; 
    public $showimptymessage = true ; 
    public $Targetid = null ; 
    public $theMessage = '';
    public $currentkey = null ;
    public $chatUser  = null ; 
    public $tempMessage  = [];
    public $initOffer = null ; 
    protected $listeners =
     ['trrigerTargetid' => 'hitchat',   
       'sentOffer' => 'makeStreamOffer',
        'rejectoffer' => 'TrejectOffer',
        'sentAnswer' => 'makeStreamAnswer',
        'connectionRTcDown' => 'ConnectionRTCDown',
     ]; 
    // protected $listeners = ;
    public function mount()
    {
    //   dd($this->getAllUser());
       $this->alluser = $this->getAllUser();
    }
  
    public function render()
    {
        return view('livewire.community');
    }

    public function getAllUser()
    {
        return User::
               where("is_admin","!=",1)
              ->with("channelconfig",function($q){
                $q-> where("user_id" , auth()->user()->id)
                  ->orWhere(function($qe){
                        $qe->where("targetid" ,auth()->user()->id) ;  
                        })
                  ->with([
                        "comment" => function($q){
                            $q->where("is_readed",0)
                              ->where("user_id","!=",auth()->id());
                            }
                    ])
                ;
               })
               ->get(["id","name","img","is_admin"]);
    }

  

    public function hitchat($id)
    {   
         $this->chatUser = '';
        $this->tempMessage = [];
         $this->showimptymessage = false ; 
         $this->Targetid = $id ;
         $this->currentkey = null ;
        $this->dispatchBrowserEvent('set-active', ['userid' => $id]);  
        $this->dispatchBrowserEvent('change-alpine');  
       
        $Channelconfig =  ChannelConfig::where(
            ["user_id" => auth()->user()->id,
            "targetid" =>  $this->Targetid  ]
           )->orWhere(function($q){
            $q->where(    
                ["user_id" => $this->Targetid,
                "targetid" => auth()->user()->id ]) ;
           }
           )->with("comment")
            ->first();
 
            if($Channelconfig == null )
            {
                $Channelconfig = new ChannelConfig ; 
                $Channelconfig->user_id = auth()->user()->id ;
                $Channelconfig->targetid = $id ;
                $Channelconfig->channel_key = uniqid() ;
                $Channelconfig->save();

                $this->currentkey = $Channelconfig->channel_key;
                broadcast(new ChatChennal($this->currentkey ,auth()->user()));
            }else{

                Comment::where(["channelconfig_id"=>$Channelconfig->id,
                "user_id"   =>  $this->Targetid
                ])->update(["is_readed"=>1]);

                $this->chatUser  = $Channelconfig->toArray()['comment'];
            }
            $this->currentkey = $Channelconfig->channel_key;
    }

    public function sentText($id)
    {
       
       
        if($this->theMessage != null)
        {
            array_push($this->tempMessage ,$this->theMessage) ;

           $channelconfid =  ChannelConfig::where('channel_key',$this->currentkey)->first('id')->id ;
           
           $comment = new Comment ;
           $comment->user_id = auth()->user()->id ;
           $comment->channelconfig_id = $channelconfid;
           $comment->body = $this->theMessage ;
           $comment->save();
           
        //    $this->dispatchBrowserEvent('set-message-inlist', ['message' =>  $this->theMessage ]);  
           $this->theMessage = '';
           broadcast(new ChatChennal($this->currentkey ,auth()->user()))
           ->toOthers()
           ;

         

        }
    } 

    

    // vidoe chat 
    public function makeStreamOffer($offer)
    {
       
        
        broadcast(new StreamOffer($this->currentkey ,auth()->user() ,$offer))
        ->toOthers()
        ;

    }
    public function makeStreamAnswer( $data)
    {
    //   dd($data);
      broadcast(new StreamAnswer($data['offerKeyChannel'],auth()->user() ,$data['finalanswer']))
    //   ->toOthers()
      ;
    }

    public function TrejectOffer($channelKey)
    {
      
        broadcast(new RejectOffer($channelKey['channelKey'],auth()->user()))
        ->toOthers()
        ;
    }
    public function ConnectionRTCDown($channelKey)
    {
        
        broadcast(new EndRTCConnction($channelKey['channelKey'],auth()->user()))
        ->toOthers()
        ;
    }
}
