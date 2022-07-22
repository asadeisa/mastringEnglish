@extends("layout.homelayout")
@section('home')
<x-user-nav/>
<script src="{{ asset('js/app.js') }}"></script>
<div class="user-interface overfly-hidden d-flex mt-5 pt-1   w-100 ">

  <x-user-aside/>
  <section class=" main-content w-95 px-2 ">
    <div class=" py-3  community-page-full ">

       
       @livewire("community")
    </div>        
  </section>
  {{-- {{ dd($keychannels) }} --}}
  <input type="hidden" id="{{ $keychannels }}" class="get-all-key-c">

  <script src="{{ asset('js/websocket.js') }}"></script>

</div>