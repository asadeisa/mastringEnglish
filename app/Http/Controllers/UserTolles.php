<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\websocketTest;
use App\Models\ChannelConfig;


class UserTolles extends Controller
{
    //
    public function askQuestion()
    {
        session(["active" =>""]);

        return view("aske-qustion");
    }
    public function catchAudio(Request $request)
    {
        dd($request);

    //     if(is_array($request->file('audio')))
    //     {
    //      $audios=array();
    //      foreach($request->file('audio') as $file) {
    //         $uniqueid=uniqid();
    //         $original_name=$file->getClientOriginalName();
    //         $size=$file->getSize();
    //         $extension=$file->getClientOriginalExtension();
    //         $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
    //         $audiopath=url('/storage/upload/files/audio/'.$filename);
    //         $path=$file->storeAs('/upload/files/audio',$filename);
    //         array_push($audios,$audiopath);
    //      }
    //      $all_audios=implode(",",$audios);
    //  }else{ 
    //      // handle single file 
    //      if($request->hasFile('audio')){
    //      $uniqueid=uniqid();
    //      $original_name=$request->file('audio')->getClientOriginalName();
    //      $size=$request->file('audio')->getSize();
    //      $extension=$request->file('audio')->getClientOriginalExtension();
    //      $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
    //      $audiopath=url('/storage/upload/files/audio/'.$filename);
    //      $path=$file->storeAs('public/upload/files/audio/',$filename);
    //      $all_audios=$audiopath;
    //     }
    // }
    }
    public function analyze()
    {
        session(["active" =>""]);

        return view("analyze");
    }
    public function communityPage()
    {
        session(["active" =>""]);

        event( new websocketTest( auth()->user()));

        $keychannels = [];
        $keys = ChannelConfig::where("user_id",auth()->user()->id)->orWhere("targetid",auth()->user()->id)->get(["channel_key"]);
     
        if($keys != null ){
            $keys->toArray();
            for($i=0;$i < count( $keys); $i++)
            {
               array_push($keychannels,$keys[$i]['channel_key'])   ;
            }

            
            $keychannels =  json_encode($keychannels);
        }
        // dd($keychannels);
        return view('community',compact("keychannels"));
    }

    // profile page  
     public function profilePge()
     {
        return view("proflile");
     }
     public function practicePage()
     {
        return view("practice") ; 
     }

    //  the page of Ai 
    public function LocalQuestion()
    {
        return view("locakQuestion");
    }
    
    public function newPhrases()
    {
        return view("newphrases");
    }
}
