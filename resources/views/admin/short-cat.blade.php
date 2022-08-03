@extends('admin.controlpanel')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <x-admin-nav/>

  <div class="container-fluid py-4">
      <div class="row">

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 px-2">
          
          <div class="card mx-4">
            <div class="card-body p-3">
              <a href="{{ route("users") }}">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers text-center">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Users</p>
                      <h5 class="font-weight-bolder mb-0">
                        100
                       
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end  ">
                    <div class="bg-gradient-primary  icon icon-shape shadow text-center border-radius-md">
                      <x-icon.user-icon/>
  
                    </div>
                 
                  </div>
                </div>
              </a>
            
            </div>
          </div>
        </div>
    

        
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          
          <div class="card mx-4">
            <div class="card-body p-3">
              <a href="{{ route("admin-teacher") }}">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers text-center">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Teacher</p>
                      <h5 class="font-weight-bolder mb-0">
                        10
                      
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                      <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
    
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          
          <div class="card mx-4">
            <a href="{{ route("show-corses") }}">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers text-center">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Courses</p>
                      <h5 class="font-weight-bolder mb-0">
                        40
                       
                      </h5>
                    </div>
                  </div>
                 
  
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                      <i class="fa-solid fa-book-bookmark"></i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
    
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 px-2">
          
          <div class="card mx-4">
            <a href="{{ route("main-test") }}">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers text-center">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Main Test</p>
                      <h5 class="font-weight-bolder mb-0">
                      25 <small class="text-sm">Questions</small>
                       
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
    


      </div>

      </div>

      @yield("drop-data")

    
  </div>
</main>



@endsection