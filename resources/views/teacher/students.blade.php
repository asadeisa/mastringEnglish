@extends('teacher.controlpanel')


@section( 'content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <x-admin-nav />
  <div class="card-title card-delete show-button-form remove-margen aligne-center d-flex p-2">
    <div class="title mx-1  ">
      <h6>Student </h6>
    </div>
  </div>
    <div class="container-fluid py-4 d-flex gap-3 ">
  
      <div class="card" >
        <div class="card-body">

          <table class="table student-tabel  table-hover">
            <thead class="">
              <tr class="thead-dark">
                <th scope="col">profile</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">level</th>
                
              </tr>
            </thead>
  
              @if($allStudent != null && count($allStudent) != 0 )
                <tbody>
                @foreach ($allStudent as $student)
                @php
                $level = " ";
                if($student->user->level == 1)
                {
                  $level = 'beginner';
                }
                elseif ($student->user->level == 2) {
                  $level = 'intermediate 1';
  
                }
                elseif ($student->user->level == 3) {
                  $level = 'intermediate 2';
  
                }
  
                else {
                  $level = 'expert';
                  
                }
                @endphp
                <tr scope="row" > 
               
                    <td  ><span class="student-image"> <img width="75" height="75" src="{{ asset($student->user->img) }}" ></span></td>  
                    <td><span>{{ $student->user->name }}</span></td>  
                    <td>
                      <a href="{{ route("go-to-student",$student->user->email) }}" class="get-user-info">
                        <span>{{ $student->user->email }}</span>
                      </a>
                    </td>  
                    <td><span>{{ $level }}</span></td>  
                
                </tr>
                
            @endforeach
                
            </tbody>
            @endif 
          </table>
        </div>

      </div>

      <div class="chat flex-1">
        
        <div class="h3 text-center bg-info mb-0">chat</div>
          <div class="contetn dark-fade d-flex gap-3 flex-items-column pt-3 pb-3">
            @foreach ($allStudent as $student)
            <section class="d-flex gap-4 p-2 align-items-center ">
              <div class="student-image">
                <img  width="75" height="75" src="{{asset($student->user->img) }}" >
              </div>
              <span class="text-center" >{{ $student->user->name }}</span>

            </section>
            @endforeach

          </div>
      </div>
  </div>
</main>
@endsection