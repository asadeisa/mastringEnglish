@extends("layout.homelayout")
@section('home')
<x-user-nav/>
<div class="user-interface d-flex mt-5 pt-1   w-100 ">

  <x-user-aside/>
  
  <section class=" main-content w-95 px-2 my-4">
    <div class=" p-3   mt-4">

        @livewire("my-path")
    </div>        
  </section>
</div>