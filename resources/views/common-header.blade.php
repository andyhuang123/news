<head>
    @yield('header-start')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> 编码会馆-wiki文档 </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="{{ asset('/static-common/img/favicon.png') }}">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{--业务特定header，交由业务填充--}}

    @empty($notUseCommonCss)
        <link rel="stylesheet" href="{{ mix('/static-common/css/common.css') }}">
    @endempty

    <script src="{{ mix('/static-common/js/common.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    </script>
     <script>
        (function(){
        var el = document.createElement("script");
        el.src = "https://s3a.pstatp.com/toutiao/push.js?6dbebb4206cc8296c054dc6f1804938dbf0cef6608aef8226e514de38493bade068717e9be95a93361eb6240c2c50eb5772b6dfc972751cf79ac4d263bbdeb65";
        el.id = "ttzz";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(el, s);
        })(window)
    </script>
    @yield('header')
</head>
