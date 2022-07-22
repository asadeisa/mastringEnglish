@extends('teacher.controlpanel')
@php
use Carbon\Carbon;
    
@endphp

@section( 'content')
@php
$level = " ";
if($userInfo->level == 1)
{
  $level = 'beginner';
}
elseif ($userInfo->level == 2) {
  $level = 'intermediate 1';

}
elseif ($userInfo->level == 3) {
  $level = 'intermediate 2';

}

else {
  $level = 'expert';
  
}
@endphp
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <x-admin-nav />
  <div class="card-title card-delete show-button-form remove-margen aligne-center d-flex p-2">
    <div class="title mx-1 d-flex  ">
      <p>Student</p> <span class="mx-1">/</span>
      <h6 class="capitalize">{{ $userInfo->name }} </h6>
    </div>
  </div>
    <div class="container-fluid py-4">
  
      <div class="card col-lg-9" >
        <div class="card-body d-flex gap-3">
          <div class="image">
            <img width="400" height="350" src="{{ asset($userInfo->img )}}" alt="no image avalabel ">
          </div>
            <div class="user-info ">
              <ul>
                <li class="font-20"><span class="text-dark mx-2 ">name</span>{{ $userInfo->name }}
                </li>
                <li class="font-20"><span class="text-dark mx-2">email</span>
                  {{ Carbon::createFromFormat('Y-m-d H:i:s', $userInfo->created_at)->format('Y-m-d ');  }}
                
                </li >
                <li class="font-20"><span class="text-dark mx-2">level</span>{{ $level }}
                </li>
              </ul>
            </div>
        </div>

      </div>

      <div class=" my-5 d-flex gap-3">
        @forelse ($userInfo->progress as $progress)
        <div class="card my-3">
          <div class=" card-body progress-user ">
            <div class="cours box ">
                  
                <div class="text-center mb-3">
                  <span class="text-dark font-20">
                    {{ $progress->coursContent->cours->description }}
                  </span>
                  <span class="text-sm text-success">
                    {{ $progress->coursContent->cours->hit_type }}
                  </span>

                </div>
                <div >
                  <span class="text-dark capitalize">cours content :
                  </span>
                  <span class="text-secondary text-sm">  {{ $progress->coursContent->description }}</span>

                
                 <span class="capitalize text-dark">cours complete :
                  </span>   <span class="text-success">{{ $progress->complet }}% </span>
                  <div>
                    <span class="text-dark capitalize">number of mistake :</span>
                    <span class="text-danger">{{ $progress->mistake->count() }}  </span>
                  </div>
                </div>
               
              
              
              
              
            </div>
          </div>
        </div>
        @empty
        @endforelse
      </div>
     
  </div>
</main>
@endsection