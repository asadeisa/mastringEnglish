@extends("layout.homelayout")
@section('home')


<x-user-nav/>
<div class="user-interface d-flex mt-5 pt-1   w-100 ">

  <x-user-aside/>
  <div class="d-none user-level-number" id="{{ auth()->user()->level }}"></div>
  <section class=" main-content w-95 px-2 my-4 d-flex justify-content-center align-items-center m-4">
    <div class="loader-tump">
      {{-- <span style="--i:0;"></span> --}}
      <span style="--i:0.1;"></span>
      <span style="--i:0.3;"></span>
      <span style="--i:0.5;"></span>
      <span style="--i:0.7;"></span>
      <span style="--i:0.9;"></span>
      <span style="--i:1;"></span>
     
     </div> 
  <div class=" card  w-100 m-2   hidden-teperry" id="water-fordata" >
    
        <div class="card-body ">
          <div class="title-text  text-primary h4">the text</div>
          <div class="text" id="injext-text">
         </div>
          <hr>
          <div class="question">
            <h5 class="my-3 mx-1 text-primary d-flex all-question-local " id="inject-questions"> Questions</h5>
            
          </div>
          <div class="get-ans my-5">
            <div class="all-button d-flex justify-content-centre gap-4">
              <button id="conform-question" class="btn btn-info btn-lg">conform</button>
              <button id="get-next-text" class="btn btn-outline-info btn-lg">next</button>

            </div>
          </div>
        </div>
      {{-- show message of ans  --}}
      <div class="message-ans">
          <h5 class="m-ti"></h5>
        <div class=" successer-ans"></div>
        <div class=" show-the-valed-ans"></div>
        <div class="close close-holder my-2">
          <button id="close-message-ans" class="btn btn-dark">close</button>
        </div>
      </div>
  </div>
  </section>
<script defer src="{{ asset("js/rita.js") }}"></script>
<script defer src="{{ asset("js/loc-question.js") }}"></script>
</div>