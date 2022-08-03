<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token()  }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>
    Edu Smart 
  </title>
 
  <!--  Social tags      -->
  <meta name="keywords" content=" dashboard">
  <meta name="description" content="lering english from start to mastring ">


  <link id="pagestyle" href="{{ asset("admin/css/soft-ui-dashboard.min2c70.css?v=1.0.3") }}" rel="stylesheet" />
  <!-- Anti-flicker snippet (recommended)  -->

  {{-- @include('sweetalert::alert') --}}
  @livewireStyles
  <link rel="stylesheet" href="{{ asset("admin/css/font-awesome.css") }}" />
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 --}}

  <link href="{{ asset("css/user.css") }}" rel="stylesheet" />
  
<body class="g-sidenav-show  bg-gray-100 ">

  <!-- End Google Tag Manager (noscript) -->

  

    @yield('home')
  


  <!--   Core JS Files   -->
  <script defer src="{{ asset("admin/js/core/popper.min.js") }}"></script>
  {{-- <script src="{{ asset("admin/js/core/bootstrap.min.js") }}"></script> --}}


<script src="{{ asset("admin/js/app.js") }}"></script>
@livewireScripts
<script defer src="{{ asset("js/speetch.js") }}"></script>
<script defer src="{{ asset("admin/js/alpine.js") }}"></script>
{{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
<script defer src="{{ asset("admin/js/font-awesome.js") }}"></script>
<script defer src="{{ asset("admin/js/soft-ui-dashboard.min2c70.js?v=1.0.3") }}">
</script>
{{-- <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
</body>

</html>