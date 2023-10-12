<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-text-direction="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('assets/website/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('assets/website/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <!-- owl carousel-->
    <link rel="stylesheet" href="{{ asset('assets/website/vendor/owl.carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/vendor/owl.carousel/assets/owl.theme.default.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('assets/website/css/custom.css') }}">
    <!-- fontawesome - for your changes-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script><![endif]-->
    @yield('css')
</head>
<body>
    <!-- navbar-->
    <header class="header mb-5">
        <!--
      *** TOPBAR ***
      _________________________________________________________
      -->
        @include('website.includes.header')
        @include('website.includes.navbar')
    </header>
    <div id="all">
        @yield('content')
    </div>
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
    @include('website.includes.footer')
    <!-- /#footer-->
    <!-- *** FOOTER END ***-->

    <!-- JavaScript files-->
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
  
      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;
  
      var pusher = new Pusher('ffd1bd592c413743eccd', {
        cluster: 'eu'
      });
  
      var channel = pusher.subscribe('pop-channel');
      channel.bind('order-notification', function(data) {
        alert(JSON.stringify(data));
      }); --}}
    </script>
    <script src="{{ asset('assets/website/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/website/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/website/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('assets/website/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/website/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js') }}"></script>
    <script src="{{ asset('assets/website/js/front.js') }}"></script>
    <script src="{{ asset('assets/website/js/custom.js') }}"></script>
    @yield('js')
</body>
</html>
