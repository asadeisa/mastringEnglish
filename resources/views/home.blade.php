@extends("layout.homelayout")
@section('home')
<x-user-nav/>
<div class="user-interface d-flex mt-5 pt-1   w-100 ">

  <x-user-aside/>
  
  <section class=" main-content w-95 px-2 my-4">

    <div class="title p-3 d-flex gap-10  mb-5">
      <div class="d-flex align-items-center flex-direction-column">

        <p class="text-white font-20">
  
        Hi <strong class="text-info">{{ auth()->user()->name }} </strong>
        take five minute  everyday to study English , you will get the result after period of time , if you had some issue or misunderstand or any straggling , we are here for you 
        
        
      </p>
      <div class="mt-5">
        <button  class="btn btn-info font-16">Support Team </button>

      </div>
      </div>
      <div class="image-cover">
        <img width="300" height="350" src="{{ asset("images/study.jpg") }}" alt="">
      </div>
    </div>
    <div class="h-50px"></div>
    <div class="content-card mt-5 p-3 d-flex gap-4 ">
      @foreach ($allCours as $cours)
          <div class="card">
          <div class="card-head d-flex justify-content-center">

            <div class="card-image">
              <img  src="{{asset( $cours->teacher->user->img) }}" >
            </div>
          </div>

            <div class="card-body">
              <h5 class="text-center">{{ $cours->teacher->user->name }}</h5>

              <div class="cours-content d-flex gap-3 h-30">
                <h6 class="text-primary">

                  {{  $cours->hit_type }}
                </h6>
                <p class="text-gray">
                  {{ $cours->description }}
                </p>
              </div>
              <div class="hidden-data-t">
                <div class="cours-discrption">
                  @foreach($cours->coursContent as $content)
                  @if($cours->hit_type == "grammar")
                  <div class="text-dark text-center d-flex align-center cours-content-style">
                    <span class="mt-2px">
                      <i class="fa-solid fa-arrow-right"></i>
                    </span>
                 
                    <p class="mx-1">{{$content->grammar_type  }}</p> 
        
                  </div>
                  @elseif($cours->hit_type == "vocabulary")
                  <div class="text-dark d-flex align-center cours-content-style">
                    <span class="mt-2px">
                      <i class="fa-solid fa-arrow-right"></i>
                    </span>
                    <p class="mx-1">{{$content->voc_type  }}</p> 
        
                  </div>
                  @endif
                  @endforeach

                </div>

              </div>
              @php
              $coursContentNumber = count($cours->coursContent); 
              $totleProgress = 0;
              $subProgress =0;
            
              for ($i=0; $i < $coursContentNumber ; $i++) { 
                foreach ($cours->coursContent[$i]->studentProgress as $key => $progress) {
                 
                  if($progress->complet!= null)
                  {
     
                    $subProgress +=$progress->complet ; 
                  }
                }
                if(count($cours->coursContent[$i]->studentProgress) != 0)
                {
   
                  $subProgress =  $subProgress/count($cours->coursContent[$i]->studentProgress);
                }
                $totleProgress +=$subProgress  ; 
                $subProgress = 0 ; 
   
              }
              $avergProgress = $totleProgress/$coursContentNumber;
              
   
             @endphp
              <div class="go-to-cours d-flex justify-content-between">
                <a href="{{ route("cours/content/",$cours->id) }}" class="btn btn-info font-14">preview</a>
                <span class="larg-icon">

                  <i
                  class="fa-solid fa-medal f-x-lg 

                  @if ($cours->rank == 5) text-success
                  @elseif($cours->rank < 5 && $cours->rank >= 3)
                  text-warning
                  @else
                  text-danger @endif

                  "></i>
                </span>
              </div>
            </div>
            <section class="overflow-h card-radius section-progress">

              <div class="progress top--1">
               <div @if ($avergProgress  < 40) class="progress-bar   bg-gradient-danger" @endif
                   @if ($avergProgress  <= 60 && $avergProgress  >= 40) class="progress-bar  bg-gradient-info" @endif
                   @if ($avergProgress <= 100 && $avergProgress  > 60) class="progress-bar bg-gradient-success" @endif
                   role="progressbar" aria-valuenow="{{ $avergProgress  }}" aria-valuemin="0"
                   aria-valuemax="100" style="width: {{ $avergProgress  }}%;">
               </div>
           </div>
            </section>
          </div>

      @endforeach
 
    </div>

    <div class="h-50px"></div>
    <div class="h-50px"></div>
    <div class="h-50px"></div>
    <div class="h-50px"></div>
    <div class="h-50px"></div>

  </section>

</div>  

 @endsection 


