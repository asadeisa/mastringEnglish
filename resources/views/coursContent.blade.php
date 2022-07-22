@extends('layout.homelayout')
@section('home')

<x-user-nav />
<div class="user-interface d-flex  mt-5 pt-1   w-100 ">
 <x-user-aside />
 
 <section class=" main-content px-2 my-4 w-100">
		@livewire("user-corse-content",["contentid"=>$id])

  </section>
  
</div>
@endsection
