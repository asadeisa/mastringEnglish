<div class="main-content w-95 "

x-data= "{
    dataShow: @entangle("datashow"),

    pronounce:function(){
        this.dataShow = 'pronounce';

    },
    isay:function(){
        this.dataShow = 'isay';

    },
    meaning:function(){
        this.dataShow = 'meaning';

    },
    natural:function(){
        this.dataShow = 'natural';

    },
    myQuestion:function(){
        this.dataShow = 'myquestion';
    },
}"
>


      
  <section class=" px-2 my-4">
    <div class=" p-3   mt-4">
        {{-- <div class="audu-recrder">

            <form action="{{ route("catch-strem") }}" method="get" enctype='multipart/form-data' >
                <div class="holder ">
                <div data-role="controls">
                    <button>Record</button>
                </div>
                <div data-role="recordings">
                </div> 
                </div>
                <button class="btn btn-info">save</button>
           </form>
        </div> --}}

        <section class="how-can-i d-flex gap-3 m-auto" >
               <div class="card py-3 @if($datashow =='pronounce') my-question-active @endif">
                   
                   <button class="unset" wire:ignore @click="pronounce()">
                       <div class="card-body">
                       <h5>how can I pronounce</h5>
                      </div>
                     </button>
                   
               </div>
               <div class="card py-3 @if($datashow =='isay') my-question-active @endif">
                   <button class="unset" wire:ignore @click="isay()">
                       <div class="card-body">
                         <h5>how can I say </h5>
                        </div>
                   </button>
               </div>
                <div class="card py-3  @if($datashow =='meaning') my-question-active @endif">
                    
                   <button class="unset" wire:ignore @click="meaning()">
                       <div class="card-body">
                        <h5>what is the meaning of  </h5>
                       </div>
                  </button>
               </div>     
                   
               <div class="card py-3  @if($datashow =='natural') my-question-active @endif">
                   <button class="unset" wire:ignore @click="natural()"><div class="card-body">
                       <h5>Does sound natural</h5>
                   </div>
                </button>
                </div>     
               <div class="card my-question @if($datashow =='myquestion') my-qu-active @endif">
                   <button class="unset" wire:ignore @click="myQuestion()"><div class="card-body px-2 py-4">
                       <h5>My Question</h5>
                   </div>
                </button>
                </div>     
                   
        </section>
    </div>  
    {{-- {{ dd($allcontent) }}       --}}
  </section>
   <div class="prev-question d-flex gap-3 mt-5 p-2"
   x-data= "{
    key :-1,
    answertext:@entangle('answertext'),
    
    localAnswer : '',
    shworeplay : function(id){
        this.key = id;
    },
    settheComment : function(idquestion)
    {
     
        this.answertext.push([idquestion,this.localAnswer]) ;

    },
    restedata: function()
    {

        this.key = -1 ;
        this.localAnswer = '';
        this.answertext = [];
    }

   }"
   @save-ans.window="restedata()"
   >
      <div   class="content-of-question p-2 d-flex gap-3  break-word flex-direction-column 
      @if($datashow == 'all' ||count($allcontent) ==0)
      align-items-center 
      @endif
      ">
        @if(count($allcontent) !=0)
         @foreach($allcontent as $content)
            <div class=" d-flex flex-direction-column gap-3 ">

                <section  class="just-question d-flex gap-3">
                    <div class="card-image">
                        <div class="teacher-follower">
                            <img src="{{ asset($content['user']['img']) }}">
                        </div>
                    </div>
                    
                    <div   class="card show-question-student p-2" id="talkbubble">
                        <div class="card-head d-flex align-items-center flex-start"><span class="text-primary mx-2">{{$content['user']['name']  }}</span> </div> 
                        <div  class="card-body ">
                            <h6 class="mx-1" >
        
                                @if( $content['a_question_type'] =='pronounce')
                                how can I pronounce 
                                @elseif( $content['a_question_type'] =='natural')
                                <div class="text-danger">dose this sound natural ? </div>
                                @elseif($content['a_question_type'] =='meaning')
                                what is the meaning of 
                                @elseif($content['a_question_type'] =='isay')
                                how can I say 
                                @endif
                            </h6>
                            <div class="d-flex  flex-direction-column gap-0">
                                @if($content['a_question_type'] =='isay')
                            
                                <p class="rtl w-100 break-word">{{ $content['a_question'] }}</p>
                            @elseif( $content['a_question_type'] =='natural' &&  $content['a_sentenses'] != null )
                            <p>{{ $content['a_question'] }} <span class="text-dark mx-1" >or</span></p>
                            
        
                            <p>{{ $content['a_sentenses'] }}</p>
        
                                @else
                                <p>{{ $content['a_question'] }}</p>
                                @endif
                                
                            </div>
                            @if(auth()->user()->id !=  $content['user_id']  )
                            <div class="reply d-flex flex-end gap-3 mb-0 py-0">
                                <button @click="shworeplay(@js($content['id'] ))" class="btn btn-outline-primary mb-0 btn-sm">reply</button>
                                @if( $content['a_question_type'] =='pronounce')
                                <span class="mt-1 voice-recorder"> <i class="fa-solid fa-microphone-lines fa-lg"></i></span>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
        
                </section>
            
                <section  x-cloak  class="d-flex gap-3  break-word flex-direction-column">
        
                    @foreach($content['ask_answer'] as $answer)
                    <section class="just-ans d-flex gap-3 ">
                            <div class="card-image">
                                <div class="teacher-follower">
                                    <img src="{{ asset($answer['user']['img']) }}">
                                </div>
                            </div>
                            
                            <div x-cloak  class="card show-question-student p-2" id="talkbubble-left">
                                <div class="card-head d-flex align-items-center flex-end"><span>(<small class="text-dark" >{{ $answer['user']['teacher'] == 1? 'teacher':'student'  }}</small>)</span><span class="text-primary mx-2">{{$answer['user']['name']  }}</span> </div>
                                <div  class="card-body d-flex p-1">
                                    <p class="px-2">{{ $answer['ans'] }}</p>
                                
                                </div>
                                @if(auth()->user()->id  ==  $answer['user_id'] )
                                <div class="card-footer pt-1 pb-0 my-0 d-flex flex-end ">
                                    <button @click="$wire.deleteComment(
                                        {{  $answer['id'] }})" class='unset text-danger my-0 '>delete</button>
                                </div>
                                @endif
                            </div>
            
                            
                        </section>
                        @endforeach
                    </section>
            </div>
                
            <template  x-cloak x-if="key == @js($content['id'])">
                
                <section  class="reply-card w-50 margin-auto">
                    <div class="card ">
                        <div class="card-body d-flex gap-3 justify-content-center">
                            <input  x-model="localAnswer" class="form-control w-75" type="text" placeholder="please be polite">
                            <button x-on:click="settheComment({{ $content['id'] }})" class="btn btn-success btn-sm">save</button>
                        </div>
                    </div>
                </section>
            </template>
         @endforeach
        @endif 
    </div>
      {{-- ################## --}}
      {{-- the question box start --}}
      {{-- ###### ################--}}
      <template x-cloak  x-if="dataShow !='myquestion'">

          <div x-cloak  x-show="dataShow !='all'  " class="side-question
      
          ">
                <div class="card w-100">
                    <div class="card-header">
                        <h6 class="text-center">
                            Ask Question
                        </h6>
                    </div>
                    <div  class="card-body">
                        <div class="show-succes margin-auto  text-success w-100  gap-3 rounded">
                            <span class="round-curcil custom-chuck">	<i class="fa-solid fa-check"></i></span>
                            <p class="m-0 "> the qeustion is add	</p>
                            </div>
                        <form  class="mt-1" >
            
                            @if($datashow =='natural')
                            <div class="form-group">
                                <input wire:model="sentence" class="form-control" type="text" placeholder="Enter the confusing sentence" >
                            </div>
                            <div class="form-group">
                                <input wire:model="secondsentence" class="form-control" type="text" placeholder=" the second one (not requerd)" >
                            </div>
            
                                
                            @elseif($datashow =='meaning')
                            <div class="form-group">
                                <input  wire:model="sentence"  class="form-control" type="text" placeholder="Enter the word or sentence " >
                            </div>
                            @elseif($datashow =='isay')
                            <div class="form-group">
                                <input  wire:model="sentence"  class="form-control" type="text" placeholder="Enter the word or sentence " >
                            </div>
                            @elseif($datashow =='pronounce')
                            <div class="form-group">
                                <input  wire:model="sentence"  class="form-control" type="text" placeholder="Enter the word or sentence " >
                                
                            </div>
                            @endif
                            <div class="save-q mt-2">
                                <button type="button" wire:click="saveQuestion()" class="btn btn-info btn-sm">save</button>
                            </div>
                        </form>
                    </div>
                </div>  
      </div>
      </template>
            
   </div>



   <script>
        let customChuck = document.querySelector('.show-succes');

    window.addEventListener('save-question', event => {
    
      customChuck.style.display = `flex`;
       setTimeout(()=>{
       customChuck.style.display = `none`;

       },2000)
    
    });
    
    </script>
</div>
