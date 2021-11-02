<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <!--<title>@yield('title')</title>-->
    <title>{{$configs['base.website_title']}}-@yield('title')</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <!--<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">-->
    <link rel="icon" type="image/png" href="{{processing_files($configs['base.website_icon'])}}">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <meta name="keywords" content="{{$configs['base.website_keyword']}}">
    <meta name="description" content="{{$configs['base.website_desc']}}">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
     
    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/material-design-icons/3.0.1/iconfont/material-icons.css">
    <link rel="stylesheet" href="{{ asset('css/font-roboto.css') }}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    <link href="{{asset(__STATIC_HOME__)}}/assets/css/paper-kit.css?v=2.2.0" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/body.css') }}">
   
    @yield('css')
    <style>
        .fixed-top {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
        }
        .nav-pills .nav-item:first-child .nav-link {
            border-radius: 0px 0 0 0px !important;
            margin: 0;
        }
        .nav-pills .nav-item:last-child .nav-link {
            border-radius: 0 0px 0px 0 !important;
        }
        .card img {
            max-width: inherit !important;
            height: auto;
           border-radius: 30px;
        }
    </style>
</head>

<body>
    
  @include('layouts._header')
  
  <div class="container"> 
    @yield('body')
  </div>
  
  @include('layouts._footer')
</body> 
    <!--   Core JS Files   -->
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/material.min.js') }}"></script> 
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('js/nouislider.min.js') }}" type="text/javascript"></script>

    <!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
    <script src="{{ asset('js/bootstrap-datepicker.js') }}" type="text/javascript"></script>

    <!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
    <script src="{{ asset('js/material-kit.js') }}" type="text/javascript"></script>
    @yield('js')
</html>








