@php
use Carbon\Carbon;
    
@endphp
@extends('admin.short-cat')

@section('drop-data')


<div class="container-fluid py-4">
  <div class="nav w-100">
    <div class="card-title card-delete w-100
    show-button-form remove-margen aligne-center d-flex p-2">
     <div class="title mx-1 ">
       Dachbord /
     </div>
     <div class="title mx-1 ">
       <h6> Student</h6>
     </div>
   </div>
</div>

  <div class="row mt-3">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>students Info</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">students</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">level</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">joined in</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @forelse ($alluser as $user)
                    {{-- {{ dd($user) }} --}}
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset($user->img) }}" class="avatar avatar-sm me-3" alt="person image">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                        <p class="text-xs text-secondary mb-0"><a href="#" class="__cf_email__" >{{ $user->email }}</a></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">
                            @php
                              $level = " ";
                              if($user->level == 1)
                              {
                                $level = 'beginner';
                              }
                              elseif ($user->level == 2) {
                                $level = 'intermediate 1';

                              }
                              elseif ($user->level == 3) {
                                $level = 'intermediate 2';

                              }

                              else {
                                $level = 'expert';
                                
                              }
                            @endphp
                            {{ $level }}
                    </p>
             
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-danger">offline</span>
                  </td>
                 
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs 
                    font-weight-bold">
                    {{ Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d ');  }}
                  </span>
                  </td>
                  <td class="align-middle">
                    <form action="{{ route("delete-student") }}" method="post">
                     @csrf
                     <input type="hidden" name="user_id" value="{{ $user->id }}">
                      <button  class="text-secondary unset font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        delete 
                        <i class="fas fa-trash-alt"></i>
  
                      </button>
                    </form>
                  </td>
                </tr>
                @empty
                    
                @endforelse

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>


@endsection
