<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StreamAnswer implements ShouldBroadcast 
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $key ;
    public $Answer ; 
    public User $user ; 

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($key,User $user , $Answer)
    {
            //
            $this->key = $key ; 
            $this->user = $user ; 
            $this->Answer = $Answer ; 
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('chat.user.'.$this->key);
        // return new PrivateChannel('channel-name');
    }
    public function broadcastWith()
    {


      return [
        "Answer" =>$this->Answer ,
        "userId" =>$this->user->id,
        "userName" =>$this->user->name,
        "key"   =>$this->key,
      ] ;
    }
}
