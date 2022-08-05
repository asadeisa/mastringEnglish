@extends('teacher.controlpanel')


@section( 'content')


<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <x-admin-nav />
  <div class="container-fluid cours-content-page py-4">

      <section class="d-flex justify-content-center profile-page align-items-center p-1 m-2"> 
        <div class="card teacher-profile mt-5">
          <div class="card-body d-flex gap-3">
            <div class="card-image">
              <img width="300" height="300" src="{{ asset(auth()->user()->img) }}" alt="">
            </div>
            <div class="content-info flex-1">
              <ul class="list-items">
                <li class="d-flex gap-3  w-100"><span class="text-secondary">name : </span> <span class="text-dark">{{ auth()->user()->name }}</span></li>
                <li class="d-flex gap-3 w-100"><span class="text-secondary">email : </span> <span class="text-info email">{{ auth()->user()->email }}</span></li>

                <li class="d-flex gap-3 w-100"><span class="text-secondary">totle cours : </span> <span class="text-info">{{ $totalCours }}</span></li>
                <li class="d-flex gap-3 w-100"><span class="text-secondary">my student : </span> <span class="text-info">{{ $totalFollower   }}</span></li> 
                <li class="d-flex gap-3 w-100">   <button class="btn btn-outline-primary mt-4 ">Edit</button></li> 
               
                
              </ul>
            
            </div>
       
          </div>
          <section class="card-footer">
            <form action="{{ route("set-glimpse") }}" method="post" class="mt-3">
              @csrf
              <input type="hidden" name="user_id" value="{{ auth()->id() }}">
             <h5> type your glimpse</h5> 
              <textarea name="glimpse"  cols="80" class="my-2 form-group form-control"  placeholder="this will show to user when they follow you" rows="3"></textarea>
                <div class="my-1">
                  <button type="submit" class="btn btn-info px-4">

                    post
                  </button>
                </div>
            </form>
          </section>
        </div>

      </section>

  </div>
</main>




@endsection