<div class="p-fixed top-0 w-100 z-index-2">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand p-0 mr-5" href="#">
            <div class="logo-container">
              <img width="100" height="100" src="{{asset("images/logo/log.jpg") }}" alt="">
            </div>
            
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route("go-home") }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">community</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">my progress</a>
              </li>
             
{{--           
              <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
              </li> --}}
            </ul>
            <div class="following-teacher d-flex gap-3 ">
              <h6 class="py-0 my-0"><span class="lin-hieght-4"> follower</span></h6>
           
              @forelse ($TeacherImage as $img)
              <a href="{{ route('teacher-path',$img['id']) }}">
                <div class="teacher-follower">
                  <img width="80" height="80" src="{{ asset($img["img"]) }}" >
                </div>
              </a>
              @empty
                  
              @endforelse
            </div>
          </div>
        </div>
      </nav>
</div>