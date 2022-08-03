@extends('teacher.controlpanel')


@section( 'content')


<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <x-admin-nav />
  <div class="container-fluid cours-content-page py-4">

    @if(count($allcourses) != null)
    <div class="card-title card-delete show-button-form remove-margen aligne-center d-flex p-2">
      <div class="title mx-1  ">
        <h6>Courses </h6>
      </div>
    </div>
    <div class="content my-all-courses d-flex mt-3 flex-wrap px-2 py-1 gap-4 ">
      @foreach($allcourses as $oncours)

      <div class="card rounded max-width-40 ">
        <div class="card-title my-1">
          <h6 class="text-center ">{{ $oncours->description }}</h6>
          <hr>
        </div>
        <div class="card-body">
          <div class="d-flex">
            <p class="w-50">level:</p>
            @switch($oncours->level)
            @case(1)
            <h6>beginner</h6>

            @break
            @case(2)
            <h6>intermediate 1</h6>
            @break
            @case(3)
            <h6>intermediate 2</h6>
            @break
            @case(4)
            <h6>expert </h6>
            @break
            @default

            @endswitch

          </div>
          <div class="d-flex p-relative">
            <p class="w-50">type:</p>
            <h6>{{ $oncours->hit_type }}</h6>
          </div>
          <div class="d-flex">
            <p class="w-50">content:</p>
            @if( count($oncours->coursContent) == null)
            <h6>empty </h6>
            <div class="p-abslote">


              <button class="btn btn-success btn-xsm" tooltip="New App" data-bs-toggle="modal" data-bs-target="#content{{ $oncours->id }}">


                <i class="fas fa-plus" data-bs-toggle="tooltip" data-bs-placement="right" title="create a content"></i>

              </button>

            </div>
            <x-modle-content id="{{ $oncours->id }}" type="{{ $oncours->hit_type }}" />

            @else
            <div class="d-flex w-50">

              <button class="btn btn-success btn-xsm  mr-1" tooltip="New App" data-bs-toggle="modal" data-bs-target="#content{{ $oncours->id }}">
                <i class="fas fa-plus" data-bs-toggle="tooltip" data-bs-placement="right" title="add more"></i>

              </button>
              <x-modle-content id="{{ $oncours->id }}" type="{{ $oncours->hit_type }}" />
            </div>
            <div>
              <a href="{{ route("cours-content",[$oncours->id,"teacherid"=>$teacherId]) }}" class="btn btn-info btn-xsm">show</a>

            </div>

            @endif
          </div>

        </div>
      </div>




      @endforeach
      <div class="card  add-button bg-dark-fade  center-items ">

        <div class="card-body" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
          <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom" class="unset">
            <i class="fa-solid fa-plus"></i>
          </button>
        </div>
      </div>
    </div>


    @else
    <div class="card col-lg-12 col-md-6 col-sm-4 max-height-vh-60 position-relative">
      <div class="card-title text-center py-5 ">
        <h6>no cours found! </h6>
      </div>
      <div class="content d-flex space-between py-3">

        <div class="card-body d-flex space-around w-50  ">
          <p class="text-responsev">creacte new cours <span class="larg-icon arrow-rest"><i class="fas fa-long-arrow-alt-right"></i> </span></p>
          <div class="bg-dark w-25 position-relative py-4 px-4
       cursor color-w d-flex justify-content-center larg-icon rounded align-items" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
            <i class="fas fa-plus"></i>
          </div>
        </div>

        <div class="img py-2 mx-2">
          <img src="{{ asset("images/new-cours.svg") }}" width="300" alt="">
        </div>
      </div>
    </div>


    @endif





  </div>
  
</main>


<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header  d-flex justify-content-center">
    <h4 class="offcanvas-title text-center" id="offcanvasBottomLabel">New cours</h4>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body  position-relative d-flex justify-content-center align-times">
    <div class="w-75 ">

      <form class="form-control " action="{{ route("new-cours") }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $teacherId }}">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class=" my-4 d-flex ">
          <label for="cours" class="form-label w-25">
            <p>coures name</p>

          </label>
          <div class="form w-50 mx-1">
            <input type="text" name="name" class="form-control" id="cours" placeholder="title off your cours">
          </div>
        </div>

        <div class="level d-flex  mx-1">
          <p class="w-25">select type of the cours</p>
          <div class="conent mx-3  d-flex w-75 justify-content-sm-start">

            <div class="form-check mr-3">
              <input class="form-check-input" type="radio" name="type" id="grammar" value="grammar">
              <label class="form-check-label" for="grammar">
                grammar
              </label>
            </div>
            <div class="form-check mx-5 pl-28 ">
              <input class="form-check-input" type="radio" name="type" id="vocabulary" value="vocabulary" checked>
              <label class="form-check-label" for="vocabulary">
                vocabulary
              </label>
            </div>
          </div>
        </div>

        <div class="level d-flex space-between mx-1">
          <div class="w-25">
            <p> select level of the cours:</p>

          </div>
          <div class="content  ml-5  w-75 d-flex justify-content-sm-start">

            <div class="form-check mx-2">
              <input class="form-check-input" type="radio" name="level" id="beginner" value="1">
              <label class="form-check-label" for="beginner">
                beginner
              </label>
            </div>
            <div class="form-check mx-5">
              <input class="form-check-input" type="radio" name="level" id="intermediate-1" value="2" checked>
              <label class="form-check-label" for="intermediate-1">
                intermediate 1
              </label>
            </div>
            <div class="form-check mx-5">
              <input class="form-check-input" type="radio" name="level" id="intermediate-2" value="3">
              <label class="form-check-label" for="intermediate-2">
                intermediate 2
              </label>
            </div>
            <div class="form-check mx-5">
              <input class="form-check-input" type="radio" name="level" id="expert" value="4">
              <label class="form-check-label" for="expert">
                expert
              </label>
            </div>
          </div>

        </div>

        <div class="form-check w-100 d-flex justify-center my-2">
          <button class="btn btn-dark w-50 d-block ">submit</button>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection
