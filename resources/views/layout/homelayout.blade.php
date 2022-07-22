<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token()  }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>
  E Learning 
  </title>
 
  <!--  Social tags      -->
  <meta name="keywords" content=" dashboard">
  <meta name="description" content="lering english from start to mastring ">


  <link id="pagestyle" href="{{ asset("admin/css/soft-ui-dashboard.min2c70.css?v=1.0.3") }}" rel="stylesheet" />
  <!-- Anti-flicker snippet (recommended)  -->

  {{-- @include('sweetalert::alert') --}}
  @livewireStyles
  <link rel="stylesheet" href="{{ asset("admin/css/font-awesome.css") }}" />


  <link href="{{ asset("css/user.css") }}" rel="stylesheet" />
  
<body class="g-sidenav-show  bg-gray-100 ">

  <!-- End Google Tag Manager (noscript) -->

  

    @yield('home')
  


  <!--   Core JS Files   -->
  <script defer src="{{ asset("admin/js/core/popper.min.js") }}"></script>
  {{-- <script src="{{ asset("admin/js/core/bootstrap.min.js") }}"></script> --}}

  <script defer src="{{ asset("admin/js/soft-ui-dashboard.min2c70.js?v=1.0.3") }}">
  </script>
<script src="{{ asset("admin/js/app.js") }}"></script>
@livewireScripts
<script defer src="{{ asset("js/speetch.js") }}"></script>
<script defer src="{{ asset("admin/js/alpine.js") }}"></script>

<script defer src="{{ asset("admin/js/font-awesome.js") }}"></script>

</body>

</html>