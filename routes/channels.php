<?php


use App\Events\ChatChennal;
use App\Models\ChannelConfig;
use App\Models\Comment;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('home.{id}', function ( $user, $id) {
    
    // if ($user->canJoinRoom($id)) {
    // }
    return ['id' => $user->id, 'name' => $user->name];
    // return true ; 
});

Broadcast::channel('chat.user.{key}', function ($user, $key) {

    $userintry =  ChannelConfig::where('channel_key',$key)->first(['user_id',"targetid"]);
    if($user->id  ==$userintry->user_id ||$user->id  ==$userintry->targetid)
    {
        // $comments = Comment::whereHas('channelconfig',function($q) use($key){
        //     $q->where("channel_key",$key);
        // })
        // ->get()->toArray();
        
        return ["key"=>$key];

    }
   
 
});