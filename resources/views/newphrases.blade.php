@extends("layout.homelayout")
@section('home')


<x-user-nav/>
<div class="user-interface d-flex mt-5 pt-1   w-100 ">

  <x-user-aside/>
  <div class="d-none user-level-number" id="{{ auth()->user()->level }}"></div> 
  <section class=" main-content w-95 px-2 my-4 d-flex justify-content-center align-items-center">

  <div  class=" card  w-100  d-flex align-items-center justify-content-center"> 
    <div class="loader-tump">
     
     </div> 
    <div id="water-fordata" class="card flex-1 w-95 newinof-page ">
      <div class="card-head "><h5 id="the-new-word" class="text-primary  text-center my-2"></h5></div>
      <div class="card-body my-2 ">
        <div class="d-flex gap-4">
          
          <strong>Meaning : </strong> <p id="meaning-ui" class="font-14"> </p>
        </div> 

      <ul id="examples-ui">
   
      </ul>  
      </div>
      <div class="card-footer">
        <div class="next-items my-4">
          <button id="get-next-word" class="btn btn-info btn-lg mx-3">Next</button>
        </div>
      </div>
    </div>

  </div>
  </section>
</div>

<script defer src="{{ asset("js/rita.js") }}"></script>
<script defer src="{{ asset("js/learn-new-word.js") }}"></script>