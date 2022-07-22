<?php

namespace App\Events;

use App\Models\User;
use App\Models\Comment;
use App\Models\ChannelConfig;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatChennal implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $key;
    
    public User $user ; 

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( $channelconf, User $user )

    {
        //
        $this->key = $channelconf ; 
        $this->user = $user ; 

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        
        return new PresenceChannel('chat.user.'.$this->key);
    }
    public function broadcastWith()
    {
          $comments = Comment::whereHas('channelconfig',function($q){
                                $q->where("channel_key",$this->key);
                               })
                               -> latest()
                               ->first(['body','user_id']);
          if($comments != null )
          {
        
          $comments  = $comments  ->toArray();
          }

      return [
        "newmessage" =>$comments ,
        
      ] ;
    }
    // public function broadcastAs()
    // {
    //     return 'chat.new';
    // }

}
