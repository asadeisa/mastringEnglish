@extends('admin.short-cat')

@section('drop-data')
<div class="my-4">
  <div class="nav w-100">
      <div class="card-title card-delete w-100
      show-button-form remove-margen aligne-center d-flex p-2">
       <div class="title mx-1 ">
         Dachbord /
       </div>
       <div class="title mx-1 ">
         <h6> Profile</h6>
       </div>
     </div>
  </div>
  <div class="container mt-4 d-flex align-items-center justify-content-center">
    <div class="card  profile-admin">
      <div class="card-body">
        <ul class="list-items">
          <li class=" d-flex gap-3 mt-1"><span>user name :</span> <span class="text-dark">{{ auth()->user()->name }}</span></li>
          <li class=" d-flex gap-3 mt-2"><span>Email:</span> <span class="text-info email">{{ auth()->user()->email }}</span></li>
          <li class=" d-flex gap-3 mt-4"><button class="btn btn-outline-primary">Edit</button></li>
        </ul>
      </div>
    </div>
  </div>
</div>

@endsection