<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html;
charset=gb2312"/>
    <meta name="sogou_site_verification" content="aDBu7EUAbZ"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{processing_files($configs['base.website_icon'])}}">
    <link rel="icon" type="image/png" href="{{processing_files($configs['base.website_icon'])}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{$configs['base.website_title']}}-@yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{$configs['base.website_keyword']}}">
    <meta name="description" content="{{$configs['base.website_desc']}}">
   
    {{--字体和图标--}}
    <link href="{{asset(__STATIC_HOME__)}}/assets/css/google-fonts/fonts-googleapis.css" rel="stylesheet" />
    <link href="{{asset(__STATIC_HOME__)}}/fontawesome-free-5.10.1-web/css/all.min.css" rel="stylesheet">
    <link href="{{asset(__STATIC_HOME__)}}/fontawesome-free-5.10.1-web/css/v4-shims.min.css" rel="stylesheet">
    <!--CSS文件-->
    <link href="{{asset(__STATIC_HOME__)}}/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{asset(__STATIC_HOME__)}}/assets/css/paper-kit.css?v=2.2.0" rel="stylesheet" />
    <!--引入自己CSS-->
    <link href="{{asset(__STATIC_HOME__)}}/assets/css/my_settings.css" rel="stylesheet" /> 
    <!-- 引入fontawesome-iconpicker Icon图标 -->
    <link rel="stylesheet" type="text/css" href="{{asset('/vendor/laravel-admin/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css')}}" />
    <!--引入jquery和pjax--> 
    <script src="{{asset(__STATIC_HOME__)}}/assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="{{asset(__STATIC_HOME__)}}/assets/pjax/jquery.pjax.js" type="text/javascript"></script>
    <!-- 多条广告如下脚本只需引入一次 -->
    <script>window.BAIDU_DUP_AUTO_AD = true;</script> 
    <script type="text/javascript" src="//cpro.baidustatic.com/cpro/ui/cm.js" async="async" defer="defer" ></script>
 
    @stack('scripts')  
  
    @if($configs['base.website_open_bg'] == 1)
        <style type="text/css">
            body {
                background-image: url('{{processing_files($configs["base.website_background"])}}');
                background-size: 100% 100%;
                background-repeat:no-repeat;
                background-attachment:fixed;
                height: auto;
                max-width: 100%;
            }
            .footer{
                background:rgba(0,0,0,0);
            }
            .navbar{
                z-index: 999;
                background:rgba(255,255,245,0.1);
            }
            .dropdown-menu{
                background: rgba(255,255,255,0.1);
            }
        </style>
    @endif
    <style>
        body { 
            background-color: #f5c84a22;
        }
    </style>
    
</head>

<body onhashchange="fix_the_nav();">

    @include('layouts.nav')
    
    @yield('content') 
    
    @include('layouts._footer') 
 
</body> 

<!--返回顶部-->
<script src="{{asset(__STATIC_HOME__)}}/jquery_goup/jquery.goup.min.js" type="text/javascript"></script>
<!--layer弹窗-->
<script src="{{asset(__STATIC_HOME__)}}/assets/layer/layer.js" type="text/javascript"></script> 
<!-- 这里是复制文本的 -->
<script src="{{asset(__STATIC_HOME__)}}/assets/clipboard/clipboard.min.js" type="text/javascript"></script>
<!--   核心JS文件   -->
<script src="{{asset(__STATIC_HOME__)}}/assets/js/core/popper.min.js" type="text/javascript"></script>

<script src="{{asset(__STATIC_HOME__)}}/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  开关插件，完整的文档如下：http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{asset(__STATIC_HOME__)}}/assets/js/plugins/bootstrap-switch.js"></script>
<!--  Sliders插件，完整文档如下：http://refreshless.com/nouislider/ -->
<script src="{{asset(__STATIC_HOME__)}}/assets/js/plugins/nouislider.min.js" type="text/javascript"></script> 
<!-- 工具箱控制中心：视差效果、示例页面脚本等 -->
<script src="{{asset(__STATIC_HOME__)}}/assets/js/paper-kit.js?v=2.2.0" type="text/javascript"></script>
 
<!--谷歌统计代码-->
{!! $configs['base.new_key_here'] !!}

@stack('backend-register-js')

<script type="text/javascript">
    //返回顶部
    $(document).ready(function() {
        $.goup({
            trigger: 100,
            bottomOffset: 40,
            locationOffset: 100,
            titleAsText: false,
            title: '返回顶部',
            containerRadius: 200,
            containerColor: "#6bd098",
            arrowColor: "#00000"
        });
    });
</script>  
<script type="text/javascript"> 
 
 $(document).ready(function() {
        //回调函数
        $(".loading").css("display", "none");
        //pjax加载结束的回调函数 解决js无法定位的问题
        var copy_qq = $("#copy_qq");
        if(copy_qq.length){
            copyqq();
        }
        var copy_wx = $("#copy_wx");
        if(copy_wx.length){
            copywx();
        } 
    });
   
    function copyqq() {
        var btns = document.querySelectorAll('#copy_qq');
        var clipboard = new ClipboardJS(btns);

        clipboard.on('success', function(e) {
            layer.msg('复制成功,请到QQ上搜索我添加');
        });

        clipboard.on('error', function(e) {
            layer.msg('复制失败,请刷新或手动输入');
        });
    }
    function copywx() {
        var btns = document.querySelectorAll('#copy_wx');
        var clipboard = new ClipboardJS(btns);

        clipboard.on('success', function(e) {
            layer.msg('复制成功,请到微信上搜索我添加');
        });

        clipboard.on('error', function(e) {
            layer.msg('复制失败,请刷新或手动输入');
        });
    }  
    function fix_the_nav() {
        if (window.location.hash) {
            var target = $(location.hash);
            $("body,html").scrollTop(target.offset().top - 100); // my nav size is 100px
        }
    }
    function runTime(){//运行倒计时
            var longTime;
            var oldTime =new Date('2019/10/01 00:00:00');
            var timer = setInterval(function(){
                var nowTime = new Date();
                var longTime = nowTime - oldTime;
                var days = parseInt(longTime / 1000 / 60 / 60 / 24 , 10); //计算剩余的天数
                  var hours = parseInt(longTime / 1000 / 60 / 60 % 24 , 10); //计算剩余的小时
                  var minutes = parseInt(longTime / 1000 / 60 % 60, 10);//计算剩余的分钟
                  var seconds = parseInt(longTime / 1000 % 60, 10);//计算剩余的秒数
                      longTime = days+"天" + hours+"小时" + minutes+"分"+seconds+"秒";
                     $('#runtime').html(longTime) 
            },1000)
    }
    runTime();
     
</script> 
 
 
</html>