@extends('home.main')
@section('title',$nav_title)
@push('scripts')
    <style>
        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 12px 12px 12px 12px;
        }

        .ui.green.label,
        .ui.green.labels .label {
            background-color: #21ba45 !important;
            border-color: #21ba45 !important;
            color: #fff !important;
        }

        .ui.red.label,
        .ui.red.labels .label {
            background-color: #ff0000 !important;
            border-color: #ff0000 !important;
            color: #fff !important;
        }

        .ui.grelly.label,
        .ui.grelly.labels .label {
            background-color: #f5ca69 !important;
            border-color: #f5ca69 !important;
            color: #fff !important;
        }


        .nav-pills .nav-item .nav-link {
            border: 0px solid #66615B;
            border-radius: 0;
            color: #66615B;
            font-weight: 100;
            margin-left: -1px;
            padding: 5px;
        }

        .nav-pills .nav-item:last-child .nav-link {
            border-radius: 0 0px 0px 0 !important;
        }

        .nav-pills .nav-item:first-child .nav-link {
            border-radius: 0px 0 0 0px !important;
            margin: 0;
        }

        .nav-pills .nav-item .nav-link.active {
            background-color: #85daaa !important;
            color: #101010 !important;
        }

        .fa,
        .fas {
            font-weight: 900;
        }

        .fa,
        .far,
        .fas {
            font-family: "Font Awesome 5 Free";
        }

        .fa,
        .fab,
        .fad,
        .fal,
        .far,
        .fas {
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            line-height: 1;
        }

        .card-announcement-animation {
            color: #f00;
            -webkit-animation: announ_animation 0.8s linear infinite;
            -moz-animation: announ_animation 0.8s linear infinite;
            -o-animation: announ_animation 0.8s linear infinite;
            -ms-animation: announ_animation 0.8s linear infinite;
            animation: announ_animation 0.8s linear infinite;
        }

        .card .carousel .carousel-inner a {
            position: unset;
            color: #FFFFFF !important;
        }

        .card .carousel .carousel-control-next,
        .carousel-control-prev {
            position: absolute;
            top: 0;
            bottom: 0;
            z-index: 1;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: center;
            width: 15%;
            color: #fff;
            text-align: center;
            opacity: .5;
            transition: opacity .15s ease;
        }

        .card .carousel .carousel-control-next,
        .carousel-control-prev {
            position: absolute;
            top: 0;
            bottom: 0;
            z-index: 1;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: center;
            width: 15%;
            color: #fff;
            text-align: center;
            opacity: .5;
            transition: opacity .15s ease;
        }

        .container {
            width: 100%;
            padding-right: 5px;
            padding-left: 5px;
            margin-right: auto;
            margin-left: auto;
        }
    </style>
@endpush
@section('content') 
<div class="container pt-5">
    <div class="title">
    </div> 
    <div class="container">
        <!--所有文章开始-->
        <div class="row mb-5">
            <div class="col-lg-9 col-md-9 topic-list">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(if_query('order', 'default')) }} {{ active_class(if_query('order', null)) }}" href="{{ Request::url() }}?order=default" style="font-size:1.2em;font-weight:200">
                                    最新
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(if_query('order', 'recent')) }}" href="{{ Request::url() }}?order=recent" style="font-size:1.2em;font-weight:200">
                                    活跃
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(if_query('order', 'click')) }}" href="{{ Request::url() }}?order=click" style="font-size:1.2em;font-weight:200">
                                    阅览量
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(if_query('order', 'goodlike')) }}" href="{{ Request::url() }}?order=goodlike" style="font-size:1.2em;font-weight:200">
                                    点赞量
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/photo/38" target="_blank" title="小程序" style="font-size:1.2em;font-weight:200">
                                    小程序
                                </a>
                            </li> 
                             <li class="nav-item">
                                <a class="nav-link" href="/wiki" target="_blank"  title="wiki" style="font-size:1.2em;font-weight:200">
                                    wiki
                                </a>
                            </li> 
                             <li class="nav-item">
                                <a class="nav-link" href="http://smoney.seedblog.cn" target="_blank"  title="新奇点" style="font-size:1.2em;font-weight:200">
                                    新奇点
                                </a>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('nav')}}" target="_blank" title="工具网址" style="font-size:1.2em;font-weight:200">
                                    工具网址
                                </a>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" href="/xigua" target="_blank" title="合成大西瓜" style="font-size:1.2em;font-weight:200">
                                    合成大西瓜
                                </a>
                            </li> 
                        </ul>
                    </div>

                    <div class="card-body">
                        @if (count($show_article))
                        <ul class="list-unstyled">
                            @foreach ($show_article as $key=>$topic)
                               @if ($key==0)
                                     @if($ispc)
                                     <li class="media">  
                                         <div class="_jyzmzucnfg"></div>  
                                     </li>
                                     <hr> 
                                     @else
                                       <li class="media"> 
                                      
                                           <div class="_zomhj0i7fbj"></div>
                                         
                                        </li>
                                       <hr> 
                                     @endif
                               
                                @endif
                                 
                                @if ($key==4)
                                    @include('ad.index',['topic'=> $ad_one])
                                @endif

                                @if ($key==6)
                                    @include('ad.index',['topic'=> $ad_two])
                                @endif

                                @if ($key==8)
                                    @include('ad.index',['topic'=> $ad_last])
                                @endif

                                @if ($key==10)
                                    @include('ad.index',['topic'=> $ad_one])
                                @endif

                                @if ($key==12)
                                    @include('ad.index',['topic'=> $ad_two])
                                @endif
                              
                                <li class="media">
                                    <div class="media-left">
                                        <a href="{{url('article_details',['id'=>$topic->id])}}">
                                            <img class="media-object img-thumbnail mr-3" style="width: 52px; height: 52px;" src="/img/avatar/avatar{{rand(1,68)}}.png" title="编码会馆" alt="{{$topic->article_title}}">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading mt-0 mb-1">
                                            <a href="{{url('article_details',['id'=>$topic->id])}}" style="font-weight: 500;font-size:1.2em;" title="{{ $topic->article_title }}" target="_blank">
                                                @if($topic->is_top)
                                                <span class="hide-on-mobile ui label status small grelly">置顶</span>
                                                @else
                                                <span class="hide-on-mobile ui label status small green">博客</span>
                                                @endif
                                                {{ $topic->article_title }}
                                            </a>
                                            <a class="float-right" href="{{url('article_details',['id'=>$topic->id])}}" target="_blank">
                                                <span class="badge badge-secondary badge-pill">
                                                    <i class="fa fa-eye"></i> {{ $topic->article_click }}
                                                </span>
                                                <span class="badge badge-secondary badge-pill">
                                                    <i class="fa fa-thumbs-o-up"></i> {{ $topic->goodlike }}
                                                </span>
                                            </a>
                                            <a href="javascript:void(0);" rel="tooltip" title="书签" class="btn btn-outline-neutral btn-round btn-just-icon" onclick='addBookmark("{{url('article_details',['id'=>$topic->id])}}")'>
                                                <i class="fa fa-bookmark-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="javascript:void(0);" rel="tooltip" title="复制分享链接" class="btn btn-outline-neutral btn-round btn-just-icon" onclick='copymark("{{url('article_details',['id'=>$topic->id])}}")'>
                                                <i class="fa fa-clone" aria-hidden="true"></i>
                                            </a>
                                        </div>

                                        <small class="media-body meta text-secondary">
                                            <a class="text-secondary" href="{{url('article',['nav_id'=>$topic->nav_id])}}" title="{{ $topic->nav_name->nav_title }}" target="_blank">
                                                <i class="far fa-folder"></i> {{ $topic->nav_name->nav_title }}
                                            </a>
                                            <span> • </span>
                                            <a class="text-secondary" href="#" title="#">
                                                <i class="far fa-user"></i>adminer
                                            </a>
                                            <span> • </span>
                                            <i class="far fa-clock"></i>
                                            @if($key_=='id')
                                            <span class="timeago" title="创建发布于：{{ $topic->created_at }}">{{ $topic->created_at->diffForHumans() }}</span>
                                            @else
                                            <span class="timeago" title="最后活跃于：{{ $topic->updated_at }}">{{ $topic->updated_at->diffForHumans() }}</span>
                                            @endif

                                        </small>
                                    </div>
                                </li>
                              
                                @if (!$loop->last)
                                   <hr>
                                @endif

                                @if ($loop->last)
                                   <hr>
                                   @include('ad.index',['topic'=> $ad_last])
                                @endif


                            @endforeach

                        </ul>

                        <!--分页开始-->
                        <div class="pagination-area">
                            {{$show_article->onEachSide(1)->appends(['search_title'=>$search_title,'page'=>Request::except('page'),'order'=>$orderby])->links('vendor.pagination.default')}}
                        </div>
                        @else
                        <div class="empty-block">暂无数据 ~_~ </div>
                        @endif
                    </div>
                </div>
                <!--分页结束-->
            </div>
            <div class="col-lg-3 col-md-3 sidebar">

                <div class="card ">
                    <div class="card-body">
                        <h5><i class="fas fa-bullhorn card-announcement-animation"></i> 博客公告</h5>
                        <div class="row">
                            <div class="col-sm-12">
                                @if(count($notice_list))
                                @foreach($notice_list as $k => $v)
                                <div class="alert alert-success alert-with-icon" data-notify="container" style="cursor: pointer;" data-toggle="modal" data-target="#notice{{$v->id}}">
                                    <div class="container">
                                        <div class="alert-wrapper" data-toggle="modal" data-target="#notice{{$v->id}}">
                                            <div class="message">
                                                <i class="fas fa-lightbulb"></i>
                                                {{$v->notice_title}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card ">
                    <div class="card-body">
                        <div class="col-sm-12 p-0">
                            <div class="input-group">
                                <input type="text" name="search_title" class="form-control" placeholder="请输入关键字全文检索" onkeydown="enkey_search()">
                                <div class="input-group-append" onclick="search_article()">
                                    <span class="input-group-text" style="cursor:pointer;">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card ">
                    <div class="card-body">
                        <div class="col-sm-12 mt-2 p-0">
                            <p class="h5"><i class="fas fa-qrcode"></i> 微信公众号 </p>
                            <img style="height: 100%;width: 100%;" src="http://www.seedblog.cn/uploads/teng_ad/qrcode_for_gh_7a8bc85b3f32_258.jpg">
                        </div>
                        <ul class="list-unstyled">
                                <li style="margin-bottom:5px; font-size: 18px; font-weight: 600; color: red;" class="border p-2">
                                     <i class="fa fa-qq"></i> 交流群  928137904
                                </li>
                                <li style="margin-bottom:5px; font-size: 18px; font-weight: 600; color: red;" class="border p-2">
                                   <a href="https://github.com/andyhuang123" title="Github Profile">
                                      <i class="icon fa fa-github"></i> github
                                    </a>
                                </li> 
                        </ul>

                    </div>
                </div>
                 <div class="card">
                    <div class="card-body">
                        <iframe width="220" height="257" frameborder="0" src="https://www.ixigua.com/iframe/6995752001829077511?autoplay=0" referrerpolicy="unsafe-url" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="card ">
                    <div class="card-body">
                        <h5><i class="fas fa-history"></i> 热门文章 </h5>
                        <ul class="list-unstyled">
                            @if(count($hot_article))
                            @foreach($hot_article as $k => $v)
                            <li class="nav-item">
                                <a href="{{url('article_details',['id'=>$v->id])}}" class="text-muted" style="font-weight: 500;font-size: 14px;" title="{{ $v->article_title }}">{{$v->article_title}}</a>
                                <a href="javascript:void(0);" class="btn btn-sm {{$button_color[$k]}} btn-link" onclick='addBookmark("{{url('article_details',['id'=>$v->id])}}")'>
                                    <i class="fa fa-bookmark-o" aria-hidden="true"></i> {{$v->article_like}}
                                </a>
                                <a href="javascript:void(0);" class="btn btn-sm {{$button_color[$k]}} btn-link">
                                    <i class="far far fa-kiss-beam" aria-hidden="true"></i> {{$v->article_click}}
                                </a>
                                <hr>
                            <li>
                                @endforeach
                                @endif
                        </ul>
                    </div>
                </div>
                <!--ads start-->
               <div class="card">
                    <div class="card-body">
                        <div id="demo" class="carousel slide" data-ride="carousel">
                            <!-- 指示符 -->
                            <ul class="carousel-indicators">
                                @if(count($ads))
                                @foreach ($ads as $key=>$ad)
                                <li data-target="#demo" data-slide-to="{{$key}}" @if($key==0) class="active" @endif></li>
                                @endforeach
                                @else
                                <li data-target="#demo" data-slide-to="0" class="active"></li>
                                @endif
                            </ul>

                            <!-- 轮播图片 -->
                            <div class="carousel-inner">
                                @if(count($ads))
                                @foreach ($ads as $key=>$ad)
                                <div class="carousel-item @if($key==0)active @endif" data-interval="3000">
                                    <a href="{{$ad->click_url}}" target="_blank">
                                        <img src="{{$ad->pict_url}}">
                                    </a>
                                    <div class="carousel-caption">
                                        <h3></h3>
                                        <p></p>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div class="empty-block">暂无数据 ~_~ </div>
                                @endif
                            </div>

                            <!-- 左右切换按钮 -->
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>

                        </div>
                    </div>
                </div>
               <!--ads ends--> 
               
                <!--订阅start-->
                <div class="card ">
                    <div class="card-body">
                        <h5> <i class="fa fa-rss-square" aria-hidden="true"></i> 邮箱订阅 </h5>
                        <div class="col-sm-12 mt-2 p-0">
                          
                            <div class="col-sm-12 border p-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="输入邮箱订阅我">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mt-1">
                                        <button class="btn btn-sm btn-primary btn-round float-right" onclick="subscribe_me()">
                                            <i class="fa fa-heart heart"></i> 订阅
                                        </button>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <!--订阅end-->
               <!--tongji start-->
                <div class="card ">
                    <div class="card-body">
                        <div class="col-sm-12 p-0">
                            <h5><i class="fas fa-chart-line"></i>本站统计 </h5>
                            <ul class="list-unstyled">
                                <li style="margin-bottom:5px" class="border p-2">
                                    <b>{{$show_article->total()}}</b>篇文章
                                </li>
                                <li style="margin-bottom:5px" class="border p-2">
                                    <b>{{$article_click}}</b>次阅读
                                </li>
                                <li style="margin-bottom:5px" class="border p-2">
                                    <b>{{$total_msg}}</b>条留言
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card ">
                    <div class="card-body">
                        <div class="col-sm-12 mt-2 p-0">
                            <p class="h5"><i class="fas fa-tags"></i>标签云</p>
                            @foreach($tag_result as $v)
                            <a href="javascript:void(0)" class="badge badge-{{$tag_color[$v->tag_color]}}  badge-pill" onclick="tag_article('{{$v->tag_content}}')">
                                {{$v->tag_content}}({{$v->article_count}})
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!--<div class="card">-->
                <!--    <div class="card-body">-->
                <!--          <div class="col-sm-12 mt-2 p-0">-->
                              <!-- home_left -->
                <!--                <ins class="adsbygoogle"-->
                <!--                     style="display:block;width:100%;min-width:30%;height:200px;"-->
                <!--                     data-ad-client="ca-pub-7696986647950902"-->
                <!--                     data-ad-slot="7699856693"-->
                <!--                     data-ad-format="auto"-->
                <!--                     data-full-width-responsive="true"></ins>-->
                <!--          </div> -->
                <!--    </div>-->
                <!--</div>-->
                
            </div>
        </div>
        <!--所有文章结束-->
    </div>
</div>
<!-- 公告弹出 modal -->
@foreach($notice_list as $k => $v)
<div class="modal fade" id="notice{{$v->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">
            <div class="modal-header no-border-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel">{{$v->notice_title}}</h5>
            </div>
            <div class="modal-body">
                {!! $v->notice_content !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-link" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('backend-register-js')
<!-- 一言插件 -->
{{--收藏--}}
<script type="text/javascript">
    function addBookmark(url, title) {
        consoel.log(url);
        if (!url) {
            url = window.location
        }
        if (!title) {
            title = document.title
        }
        var browser = navigator.userAgent.toLowerCase();
        if (window.sidebar) { // Mozilla, Firefox, Netscape
            window.sidebar.addPanel(title, url, "");
        } else if (window.external) { // IE or chrome
            if (browser.indexOf('chrome') == -1) { // ie
                window.external.AddFavorite(url, title);
            } else { // chrome
                layer.msg('请按ctrl+d（或macs的command+d）将此页加入书签。');
            }
        } else if (window.opera && window.print) { // Opera - automatically adds to sidebar if rel=sidebar in the tag
            return true;
        } else if (browser.indexOf('konqueror') != -1) { // Konqueror
            layer.msg('请按ctrl+b将此页加入书签。');
        } else if (browser.indexOf('webkit') != -1) { // safari
            layer.msg('请按ctrl+b（或macs的command+d）将此页加入书签。');
        } else {
            layer.msg('您的浏览器无法使用此链接添加书签。请手动添加此链接。')
        }
    }

    function copymark(url, title){

        copyText(url);//执行复制
        layer.msg('复制分享链接成功');
    }

    function copyText(text) {
        var textarea = document.createElement("input");//创建input对象
        var currentFocus = document.activeElement;//当前获得焦点的元素
        document.body.appendChild(textarea);//添加元素
        textarea.value = text;
        textarea.focus();
        if(textarea.setSelectionRange)
            textarea.setSelectionRange(0, textarea.value.length);//获取光标起始位置到结束位置
        else
            textarea.select();
        try {
            var flag = document.execCommand("copy");//执行复制
        } catch(eo) {
            var flag = false;
        }
        document.body.removeChild(textarea);//删除元素
        currentFocus.focus();
        return flag;
    }
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function subscribe_me() {
        var email_name = $("input[name='email']").val();
        if (email_name == '' || email_name == undefined || email_name == null) {
            layer.msg('订阅邮箱号不能为空!');
            return false;
        }
        var pattern = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (pattern.test(email_name) !== true) {
            layer.msg('订阅邮箱格式错误!');
            return false;
        }
        var url = "{{url('subscribe')}}";
        $.ajax({
            url: url,
            dataType: "json",
            data: {
                email_name: email_name
            },
            type: "post",
            beforeSend: function() {
                var index = layer.load(1, {
                    shade: [0.1, '#fff'] //0.1透明度的白色背景
                });
            },
            success: function(data) {
                layer.closeAll();
                layer.msg(data.msg);
            },
            error: function(data) {
                layer.closeAll();
                if (data.responseJSON.errors) {
                    var get_name = ['email_name'];
                    var lenght = get_name.length;
                    var err_msg = data.responseJSON.errors;
                    for (var i = 0; i < lenght; i++) {
                        var err_name = get_name[i];
                        if (err_msg[err_name]) {
                            layer.msg(err_msg[err_name][0]);
                            break;
                        }
                    }
                } else {
                    layer.msg('订阅失败,请重试');
                }
            }
        });
    }

    function enkey_search() {
        if (event.keyCode != 13) {
            return;
        }
        search_article();
    }

    function search_article() {
        // 取得要提交页面的URL地址
        var url = "{{{url()->current()}}}";
        // 取得要提交的参数
        var search_title = $("input[name='search_title']").val();

        // 创建Form
        var form = $('<form id="search_form"></form>');
        form.attr('action', url); // 设置Form表单的action属性
        form.attr('method', 'get'); // 设置Form表单的method属性
        var csrf = '@csrf';
        form.append(csrf);
        // 创建input
        var input_title = $('<input type="text" name="search_title" />');
        input_title.attr('value', search_title); // 设置input的value属性

        // 把input添加到表单中
        form.append(input_title);
        // 把表单添加到document.body中（不然在谷歌浏览器中会报错）
        $(document.body).append(form);

        // 提交表单（当然也可以通过AJAX来提交了，只要你喜欢）
        form.submit();
        $("#search_form").remove();
        return false;
    }

    function tag_article($tag_content) {
        // 取得要提交页面的URL地址
        var url = "{{{url()->current()}}}";
        // 创建Form
        var form = $('<form id="tag_form"></form>');
        form.attr('action', url); // 设置Form表单的action属性
        form.attr('method', 'get'); // 设置Form表单的method属性
        var csrf = '@csrf';
        form.append(csrf);
        // 创建input
        var input_tag = $('<input type="text" name="tag_content" />');
        input_tag.attr('value', $tag_content); // 设置input的value属性 
        // 把input添加到表单中
        form.append(input_tag);
        // 把表单添加到document.body中（不然在谷歌浏览器中会报错）
        $(document.body).append(form);
        // 提交表单（当然也可以通过AJAX来提交了，只要你喜欢）
        form.submit();
        $("#tag_form").remove();
        return false;
    }
     
     (window.slotbydup = window.slotbydup || []).push({
        id: "u6554783",
        container: "_zomhj0i7fbj",
        async: true
    });
    (window.slotbydup = window.slotbydup || []).push({
        id: "u6554786",
        container: "_jyzmzucnfg",
        async: true
    });
 
 
</script>
@endpush