@extends('teacher.controlpanel')

@section('content')

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <x-admin-nav/>
    
    <div class="container-fluid py-4">
     <div class="student">
       <div class="row mt-4">
         <div class="col-lg-12 mb-lg-4 mb-6">
           <div class="card px-3">
             <div class="card-title">

             
             </div>
             <div class="card-body py-3">
               <div class="border-radius-lg py-3 pe-1 mb-3 d-flex gap-4 ">
                 @forelse ($Teacherwithstudnt->follower as $student)
                 <div class=" img-profile ">
                   <a href="#">
                      <img width="100" height="100" src="{{ asset($student->user->img) }}" >
                    </a>
                 </div>
                     
                 @empty
                     
                 @endforelse
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card z-index-2">
            <div class="card-body p-3">
              <div class="  border-radius-lg py-3 pe-1 mb-3  ">

           <p class="text-center text-secondary text-xs font-weight-bolder opacity-7"> courses </p><hr>
                <div class="position-relative  ">

                  <div class="all-courses d-flex gap-5 align-items-center justify-content-start px-5  pt-3">
                      @forelse ($allcourses as $cours)
                      @php
                          $level = " ";
                          if($cours->level == 1)
                          {
                            $level = 'beginner';
                          }
                          elseif ($cours->level == 2) {
                            $level = 'intermediate 1';

                          }
                          elseif ($cours->level == 3) {
                            $level = 'intermediate 2';

                          }

                          else {
                            $level = 'expert';
                            
                          }
                          @endphp
                      <section class="book-cours">
                        <div  class="c-book bg-gradient bg-dark  mb-3 d-block  color-w  text-center">
                          <a class="color-w-h  color-w" href="{{ route("cours-content",[$cours->id,"teacherid"=>auth()->id()]) }}">
                          <div class="m-4 p-1 pointer-none"></div>
                          <h4 class="mt-5">{{ $cours->description }}</h4>
                          <span class="text-success">for </span> <h5>{{ $level }}</h5>
                        </a>
                         </div>
                      </section>    
                      @empty
                          
                      @endforelse
                  </div>
                </div>
               
              </div>
            </div>
          </div>
        </div>
   
      </div>

    </div>
  </main>

  @endsection