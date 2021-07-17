<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" type="image/png" href="{{ asset('assets/client/img/logo-icon.png') }}">
      <title>{{ config('app.name') }} - @yield('title')</title>
      <!-- Slick Slider -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/client/vendor/slick/slick.min.css') }}"/>
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/client/vendor/slick/slick-theme.min.css') }}"/>
      <!-- Custom fonts for this template-->
      <link href="{{ asset('assets/client/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
      <!-- Custom styles for this template-->
      <link href="{{ asset('assets/client/css/osahan.min.css') }}" rel="stylesheet">
   </head>
<body id="page-top">
      @yield('content')
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/client/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/client/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/client/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- slick Slider JS-->
<script type="text/javascript" src="{{ asset('assets/client/vendor/slick/slick.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/client/js/osahan.min.js') }}"></script>
</body>
</html>
