<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{processing_files($configs['base.website_icon'])}}">
    <link rel="icon" type="image/png" href="{{processing_files($configs['base.website_icon'])}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{$configs['base.website_title']}}-@yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{$configs['base.website_keyword']}}">
    <meta name="description" content="{{$configs['base.website_desc']}}">
    <meta name="sogou_site_verification" content="K8D77UDvXb"/>
    <script data-ad-client="ca-pub-7696986647950902" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script data-ad-client="ca-pub-7696986647950902" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    {{--字体和图标--}}
    <link href="{{asset(__STATIC_HOME__)}}/assets/css/google-fonts/fonts-googleapis.css" rel="stylesheet" />
    <link href="{{asset(__STATIC_HOME__)}}/fontawesome-free-5.10.1-web/css/all.min.css" rel="stylesheet">
    <link href="{{asset(__STATIC_HOME__)}}/fontawesome-free-5.10.1-web/css/v4-shims.min.css" rel="stylesheet">
    <!--CSS文件-->
    <link href="{{asset(__STATIC_HOME__)}}/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{asset(__STATIC_HOME__)}}/assets/css/paper-kit.css?v=2.2.0" rel="stylesheet" />
    <!--引入自己CSS-->
    <link href="{{asset(__STATIC_HOME__)}}/assets/css/my_settings.css" rel="stylesheet" />
    <!--引入jquery和pjax--> 
    <script src="{{asset(__STATIC_HOME__)}}/assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="{{asset(__STATIC_HOME__)}}/assets/pjax/jquery.pjax.js" type="text/javascript"></script>
  
    <!--返回顶部-->
    <script src="{{asset(__STATIC_HOME__)}}/jquery_goup/jquery.goup.min.js" type="text/javascript"></script>
    <!--layer弹窗-->
    <script src="{{asset(__STATIC_HOME__)}}/assets/layer/layer.js" type="text/javascript"></script>
    <!--DPlayer视频播放器-->
    <script src="{{asset(__STATIC_HOME__)}}/assets/dplay/DPlayer.min.js"></script>
    <!-- 这里是复制文本的 -->
    <script src="{{asset(__STATIC_HOME__)}}/assets/clipboard/clipboard.min.js" type="text/javascript"></script>
    <!--https://pandao.github.io/editor.md/examples/开源在线MarkDown编辑器-->
    <link rel="stylesheet" href="{{asset(__STATIC_HOME__)}}/editormd/css/editormd.css" />
    <link rel="stylesheet" href="{{asset(__STATIC_HOME__)}}/editormd/css/editormd.preview.css" />
    <script src="{{asset(__STATIC_HOME__)}}/editormd/lib/marked.min.js"></script>
    <script src="{{asset(__STATIC_HOME__)}}/editormd/lib/prettify.min.js"></script>
    <script src="{{asset(__STATIC_HOME__)}}/editormd/lib/raphael.min.js"></script>
    <script src="{{asset(__STATIC_HOME__)}}/editormd/lib/underscore.min.js"></script>
    <script src="{{asset(__STATIC_HOME__)}}/editormd/lib/sequence-diagram.min.js"></script>
    <script src="{{asset(__STATIC_HOME__)}}/editormd/lib/flowchart.min.js"></script>
    <script src="{{asset(__STATIC_HOME__)}}/editormd/lib/jquery.flowchart.min.js"></script>
    <script src="{{asset(__STATIC_HOME__)}}/editormd/editormd.min.js"></script>
    <!-- 图片放大所需的JS-->
    <script src="{{asset(__STATIC_HOME__)}}/assets/fancybox/jquery.fancybox.min.js"> </script> 

    <!-- 引入fontawesome-iconpicker Icon图标 -->
    <link rel="stylesheet" type="text/css" href="{{asset('/vendor/laravel-admin/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css')}}" />
    <!--<script src="{{asset(__STATIC_HOME__)}}/assets/js/socke.js"></script>-->
    <!--谷歌统计代码-->
    {!! $configs['base.new_key_here'] !!}

    @if($configs['base.website_open_bg'] == 1)
        <style type="text/css">
            body {
                background-image: url('{{processing_files($configs['base.website_background'])}}');
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
</head>

<body onhashchange="fix_the_nav();">
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="{{url('/')}}" rel="tooltip" data-placement="bottom">
               <span><img src="/img/logo.jpeg" width="25px" height="25px" style="border-radius: 12px;"/></span> {{$configs['base.website_title']}}
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
                @foreach($nav_list as $nav)
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false">
                        {{$nav->nav_title}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-success">
                        @foreach($nav->son_nav as $son_nav)
                            <a href="{{url($son_nav->nav_route,['nav_id'=>$son_nav->id])}}" class="dropdown-item">
                                {{$son_nav->nav_title}}
                            </a>
                        @endforeach
                    </div>
                </li>
                @endforeach
                <li class="dropdown nav-item">
                   <a class="nav-link" href="{{url('line')}}">
                       归档在线
                    </a>
                </li>
                <!--<li class="dropdown nav-item">-->
                <!--    <a class="nav-link" href="{{url('lounge')}}" target="_blank">-->
                <!--        聊天室-->
                <!--    </a>-->
                <!--</li>-->
                <li class="dropdown nav-item">
                    <a class="nav-link" href="{{url('friends')}}">
                        优秀博主
                    </a>
                </li> 
                <!--<li class="dropdown nav-item">-->
                <!--    <a class="nav-link" href="{{url('good')}}">-->
                <!--         福利推荐-->
                <!--    </a>-->
                <!--</li>-->
                <li class="dropdown nav-item">
                    <a class="nav-link" href="{{url('about')}}">
                        关于博客
                    </a>
                </li>
                @if (!session('uid'))
                  <li class="dropdown nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fa fa-user"></i>登录</a></li> 
                @else 
                    <li class="dropdown nav-item">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              @if(!session('avatar')) 
                              <img src="/img/avatar/avatar15.png" class="img-responsive img-circle" width="30px" height="30px">
                              @else
                              <img src="{{session('avatar')}}" class="img-responsive img-circle" width="30px" height="30px">
                              @endif
                              {{session('uname')}}
                            </a>
                         <div class="dropdown-menu" aria-labelledby="navbarDropdown"> 
                           <a class="dropdown-item" href="{{ route('center') }}">个人中心</a>
                           <a class="dropdown-item" id="logout" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">退出</a>
                              <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                                {{ csrf_field() }}
                              </form>
                        </div>
                    </li>
                @endif  
            </ul>
        </div>
    </div>
</nav>
<!-- <div id="pjax-container"> -->
<div class="container"> 
@yield('content')
</div>
@include('layouts._footer')
  
<div class="loading" style="display: none;"> <div id="loader"></div></div>
</body>
<!--   核心JS文件   -->
<script src="{{asset(__STATIC_HOME__)}}/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="{{asset(__STATIC_HOME__)}}/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  开关插件，完整的文档如下：http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{asset(__STATIC_HOME__)}}/assets/js/plugins/bootstrap-switch.js"></script>
<!--  Sliders插件，完整文档如下：http://refreshless.com/nouislider/ -->
<script src="{{asset(__STATIC_HOME__)}}/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  pplugin用于日期选取器，完整文档如下：https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="{{asset(__STATIC_HOME__)}}/assets/js/plugins/moment.min.js"></script>
<script src="{{asset(__STATIC_HOME__)}}/assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- 工具箱控制中心：视差效果、示例页面脚本等 -->
<script src="{{asset(__STATIC_HOME__)}}/assets/js/paper-kit.js?v=2.2.0" type="text/javascript"></script>
 

<script type="text/javascript">
    //返回顶部
    $(document).ready(function() {
        $.goup({
            trigger: 100,
            bottomOffset: 40,
            locationOffset: 100,
            titleAsText: true,
            title: '返回顶部',
            containerRadius: 200,
            containerColor: "#6bd098",
            arrowColor: "#00000"
        });
    });
</script> 
<!--TocHelper 是一款给文章自动生成目录及侧边栏目录滚动特效的插件-->
<link href="{{asset(__STATIC_HOME__)}}/toc-helper/css/toc-helper.css" rel="stylesheet"/>
<script src="{{asset(__STATIC_HOME__)}}/toc-helper/js/toc-helper.min.js"></script>
 
<script type="text/javascript">
    // $(document).pjax('a:not(a[target="_blank"],a[no-pjax])', '#pjax-container',{timeout:3000});
    // $(document).on('pjax:send', function() {
    //     $(".loading").css("display", "block");
    // });
    // $(document).on('submit', 'form', function(event) {
    //     $.pjax.submit(event, '#pjax-container')
    // });
    $(document).on('pjax:complete', function() {
        //回调函数
        $(".loading").css("display", "none");
        //pjax加载结束的回调函数 解决js无法定位的问题
        //重新定位容器内容的函数写在这里
        var dplayer = $("#dplayer");
        if(dplayer.length){
            dplay();
        }
        var copy_qq = $("#copy_qq");
        if(copy_qq.length){
            copyqq();
        }
        var copy_wx = $("#copy_wx");
        if(copy_wx.length){
            copywx();
        }
        var editor = $("#test-editor");
        if(editor.length){
            markdown();
        }
        var photo_group = $('photo_group');
        if(photo_group.length){
            photo();
        }
    });
    function dplay() {
        var video_url = $("input[name='video_url']").val();
        const dp = new DPlayer({
            container: document.getElementById('dplayer'),
            video: {
                url: video_url
            },
        });
        //绑定播放事件
        dp.on('play', function() {

        });
    }
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
    function markdown() {
        var testEditor;
        $(function() {
            testEditor = editormd.markdownToHTML("test-editor", { //注意：这里是上面DIV的id
                htmlDecode: "style,script,iframe",
                emoji: true,
                taskList: true,
                tocm: true,
                markdownSourceCode: false, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
                flowChart: true, // 默认不解析
                sequenceDiagram: true, // 默认不解析
                codeFold: true
            });
        });
        $(document).ready(function() {
          
            if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
                    const scroll = document.querySelector('#scroll')
                    const tocHelper = new TocHelper({
                        dom: 'div[data-toc]',
                        offsetBody: document.querySelector('#scroll'),
                        tocFixed:false,
                        showBefore: function () { 
                            scroll.classList.remove('col-sm-12')
                        },
                        hiddenAfter: function () {
                            scroll.classList.add('col-sm-12')
                        }
                    })
                    tocHelper.reset()
                   
                   
                }else{
                    const scroll = document.querySelector('#scroll')
                    const tocHelper = new TocHelper({
                        dom: 'div[data-toc]',
                        offsetBody: document.querySelector('#scroll'),
                        tocFixed: {
                            top: 130,
                        },
                        showBefore: function () { 
                            scroll.classList.remove('col-sm-12')
                        },
                        hiddenAfter: function () {
                            scroll.classList.add('col-sm-12')
                        }
                    })
                    tocHelper.reset()
                }
              
                const switchBtn = function () {
                    scroll.classList.contains('normal') ? (scroll.classList.remove('normal'), scroll.classList.add('scroll')) : (scroll.classList.add('normal'), scroll.classList.remove('scroll'))
                    tocHelper.megre({ offsetBody: document.querySelector('#scroll') }).reload()
                }
        });
    }

    function photo() {
        $('[data-fancybox="gallery"]').fancybox({
            // Options will go here 
                maxWidth    : 800,
                maxHeight   : 600,
                fitToView   : false,
                width       : '70%',
                height      : '70%',
                autoSize    : false,
                closeClick  : false,
                openEffect  : 'none',
                closeEffect : 'none' 
        });
    }
    function fix_the_nav() {
        if (window.location.hash) {
            var target = $(location.hash);
            $("body,html").scrollTop(target.offset().top - 100); // my nav size is 100px
        }
    }
</script>
<script>
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