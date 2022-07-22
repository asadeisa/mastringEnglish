<?php

namespace App\Events;

use App\Models\User;
use App\Models\ActiveUser;
use App\Models\ChannelConfig;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class websocketTest implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user ; 
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( User $user )
    {
        //
      $this->user = $user ; 

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('name');
        
        return new PresenceChannel('home.1');
    }
    public function broadcastWith()
    {
   
      // return [
      //   "user" =>$this->user->only(['id','name'])
      // ] ;
    }
}
