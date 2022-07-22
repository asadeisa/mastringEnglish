@extends("layout.homelayout")
@section('home')
@php
$level = " ";
if(auth()->user()->level == 1)
{
  $level = 'beginner';
}
elseif (auth()->user()->level == 2) {
  $level = 'intermediate 1';

}
elseif (auth()->user()->level == 3) {
  $level = 'intermediate 2';

}

else {
  $level = 'expert';
  
}
@endphp
<link rel="stylesheet" href="{{ asset("css/profile.css") }}">
<x-user-nav/>
<div class="user-interface d-flex mt-5 pt-1   w-100 ">

  <x-user-aside/>
  
  <section class=" main-content w-95 px-2 my-4 d-flex justify-content-center align-items-center">
 
    <div class="profile-page col-lg-8">
      <div class="card card-lg marign-auto  p-2">
        <div class="card-body d-flex gap-4">
          <div class="card-image flex-1">
              <img width="200" height="200" src="{{ asset(auth()->user()->img) }}" alt="no imgae">
          </div>
          <div class="card-content flex-1 mx-2 mt-5">
            
              <ul class="list-group">
                <li> <label  >user name</label> <span>{{ auth()->user()->name }}</span> </li>
                <li> <label >Email</label> <span>{{ auth()->user()->email }}</span> </li>
                <li> <label >level</label> <span>{{ $level  }}
                </span> </li>
                <div class="my-3"></div>
                <div class="change-info text-center mt-5">
                  <button class="btn btn-success ">change your info</button>
                </div>
              </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>