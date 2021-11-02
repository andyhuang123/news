@extends('home.main')

@section('title',$article_result->article_title)

@push('scripts')
<script>
    (function() {
        var el = document.createElement("script");
        el.src = "https://s3a.pstatp.com/toutiao/push.js?6dbebb4206cc8296c054dc6f1804938dbf0cef6608aef8226e514de38493bade068717e9be95a93361eb6240c2c50eb5772b6dfc972751cf79ac4d263bbdeb65";
        el.id = "ttzz";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(el, s);
    })(window)
</script>
<!--https://pandao.github.io/editor.md/examples/开源在线MarkDown编辑器-->
<link rel="stylesheet" href="{{asset(__STATIC_HOME__)}}/editormd/css/editormd.css" />
<link rel="stylesheet" href="{{asset(__STATIC_HOME__)}}/editormd/css/editormd.preview.css" />
<link rel="stylesheet" type="text/css" href="{{asset(__STATIC_HOME__)}}/assets/share/share.css" />
<script src="{{asset(__STATIC_HOME__)}}/editormd/lib/marked.min.js"></script>
<script src="{{asset(__STATIC_HOME__)}}/editormd/lib/prettify.min.js"></script>
<script src="{{asset(__STATIC_HOME__)}}/editormd/lib/raphael.min.js"></script>
<script src="{{asset(__STATIC_HOME__)}}/editormd/lib/underscore.min.js"></script>
<script src="{{asset(__STATIC_HOME__)}}/editormd/lib/sequence-diagram.min.js"></script>
<script src="{{asset(__STATIC_HOME__)}}/editormd/lib/flowchart.min.js"></script>
<script src="{{asset(__STATIC_HOME__)}}/editormd/lib/jquery.flowchart.min.js"></script>
<script src="{{asset(__STATIC_HOME__)}}/editormd/editormd.min.js"></script>
<style>
    p {
        font-size: 15px;
        line-height: 1.5em;
        font-weight: 500;
    }
</style>
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
    <div class="title"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb" style="background-color: #ffff;">
                    <li class="trail-item trail-begin"><a href="/"><i class="fa fa-home" aria-hidden="true"></i>首页 >> </a></li>
                    <li class="trail-item trail-end active">
                      {{$article_result->article_title}}  
                    </li>
                </ul>
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-trail breadcrumbs">
                <!--<a href="/jd_activity_list">-->
                <!-- <image style="width:100%;height:150px" src="/uploads/teng_ad/jd.png" mode="aspectFit|aspectFill|widthFix" lazy-load="false" binderror="" bindload="" />-->
                <!-- </a>--> 
              <div class="_2sl288kbf0g"></div>
            </div>
        </div>
    </div> 
    <!--右侧边栏开始-->
    <div class="row">
        <div class="col-sm-9" data-parallax="true">
            <div class="card">
                <div class="card-body">
                    <main class="col-sm-12 bd-content pb-4">
                        <h4 class="bd-title">{{$article_result->article_title}}</h4>
                        <blockquote class="blockquote text-right">
                            <p class="mb-0">
                                &nbsp;&nbsp;
                                <a class="text-secondary" href="{{url('article',['nav_id'=>$article_result->nav_id])}}" title="{{ $article_result->nav_name->nav_title }}" target="_blank">
                                    <i class="far fa-folder"></i> {{ $article_result->nav_name->nav_title }}
                                </a>
                                &nbsp;&nbsp;
                                <i class="fa fa-eye"></i>{{$article_result->article_click}}
                                &nbsp;&nbsp;
                                <i class="fa fa-comments-o"></i>{{$article_message->total()}}
                                &nbsp;&nbsp;
                                  创建时间：{{$article_result->created_at}}</p>
                                <a href="javascript:void(0);" rel="tooltip" title="复制链接分享" onclick='copymark("{{url('article_details',['id'=>$article_result->id])}}")'>
                                <i class="fa fa-share-alt-square" aria-hidden="true"></i>
                                </a>
                        </blockquote>
                        <div class="col-sm-12 m-2">
                            @php
                            $tags = explode(',',$article_result->article_tag);
                            @endphp
                            @foreach($tags as $k => $tag)
                            <span class="badge badge-{{$badge_arr[$k]}} badge-pill">{{$tag}}</span>
                            @endforeach
                        </div>
                        <div class="col-sm-12 p-0 normal" id="scroll">
                            <div id="test-editor" data-toc="#toc">
                                <textarea style="display:none;">{{$article_result->article_content}}</textarea>
                            </div>
                        </div>
                    </main>
                </div>
             </div>
          <div class="card">
            <div class="card-body">
                    <div class="row">
                         @if($ispc)
                         <div class="_h1vg9vb3rbh"></div>
                         @else
                          <div class="_t0wrm8shfrs"></div>
                         @endif 
                        
                    </div>
             </div>
           </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="share-dialog-cont">
                                <div class="share-platform">
                                    <div class="share-platform-l" style="width:auto;margin-top:14px">分享:</div>
                                    <div class="share-platform-r">
                                        <div class="bdsharebuttonbox">
                                            <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                                            <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                                            <a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
                                            <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-sm-12">
                                <div class="text-center" style="margin-top: 14px;">
                                    <button type="button" class="btn btn-primary btn-round btn-sm" onclick="goodlike({{$article_result->id}})">
                                        <i class="fa fa-thumbs-o-up"></i>
                                        点赞<span id="goodlike">
                                            @if ( $article_result->goodlike > 100)
                                            100+
                                            @else
                                            {{$article_result->goodlike}}
                                            @endif
                                        </span>
                                    </button>

                                    <button type="button" class="btn btn-primary btn-round btn-sm" onclick="favorites({{$article_result->id}})">
                                        @if($is_favorit)
                                        <i class="fa fa-heart heart"></i>
                                        @else
                                        <i class="fa fa-heart-o"></i>
                                        @endif
                                        收藏
                                    </button>

                                    <button type="button" class="btn btn-primary btn-round btn-sm" onclick="subemail({{$article_result->id}})">
                                        <i class="fa fa-eye"></i>
                                        订阅
                                    </button>
                                    <button type="button" class="btn btn-primary btn-round btn-sm" onclick="addBookmark('{{$article_url}}','buffer now')">
                                        <i class="fa fa-bookmark-o"></i>
                                        书签
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3" id="toc-container">
           <div class="row mt-3">
                <div class="card ">
                    <div class="card-body">
                        <div class="col-sm-12">
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
           </div>
           <div class="row mt-3">   
               <div class="toc" id="toc"></div>      
           </div> 
           <div class="row mt-3">
               <div class="card">
                    <div class="card-body">
                        <h5><i class="fa fa-shopping-bag" aria-hidden="true"></i> 外卖省钱小程序 </h5>
                        <div class="carousel slide" data-ride="carousel">
                         <img style="height: 100%;width: 100%;" src="http://www.seedblog.cn/uploads/article/2021-04-06/PsCzCPotblLa3lt8VMY4yvbOTHaStx5a8hIGVno3.jpg">
                        </div>
                    </div>
                </div>
           </div>
            <div class="row mt-3">
               <div class="card">
                    <div class="card-body">
                         <div class="_9u5ituvlffw"></div>
                    </div>
                </div>
           </div>
         
           <div class="row mt-3">
               <div class="card">
                    <div class="card-body">
                        <h5><i class="fa fa-shopping-bag" aria-hidden="true"></i>  广告推荐 </h5>
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
                                         <p> </p>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div class="carousel-item">暂无数据 ~_~ </div>
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
           </div>
        </div>

       
    </div>
    <!--右侧边栏结束-->

    <div class="row">
        <div class="col-sm-9">
            <div class="row mt-3">
                <div class="col-sm-12">
                    @if($pre_article)
                    <a href="{{url('article_details',['a_id'=>$previousPostID])}}">
                        <div class="pull-left">
                            <button class="btn btn-sm btn-success btn-round" type="button">
                                <i class="fa fa-angle-left"></i>上一篇 : {{str_limit($pre_article->article_title,30,'...')}}
                            </button>
                        </div>
                    </a>
                    @else
                    <a href="#">
                        <div class="pull-left">
                            <button class="btn btn-sm btn-success btn-round" type="button">
                                <i class="fa fa-angle-left"></i>没有了
                            </button>
                        </div>
                    </a>
                    @endif
                    @if($next_article)
                    <a href="{{url('article_details',['a_id'=>$nextPostID])}}">
                        <div class="pull-right">
                            <button class="btn btn-sm btn-success btn-round" type="button">
                                {{str_limit($next_article->article_title,30,'...')}} : 下一篇 <i class="fa fa-angle-right"></i>
                            </button>
                        </div>
                    </a>
                    @else
                    <a href="#">
                        <div class="pull-right">
                            <button class="btn btn-sm btn-success btn-round" type="button">
                                没有了 <i class="fa fa-angle-right"></i>
                            </button>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-9 mt-3">
            <div class="card">
                <div class="card-header bg-transparent">
                    <p>
                        <h5><i class="fa fa-check" aria-hidden="true" style="color: #1cb71c;"></i> 推荐文章 </h5>
                    </p>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach ($recommend_article as $topic)
                        <li class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object img-thumbnail mr-3" style="width: 52px; height: 52px; border-radius: 30px;" src="/img/avatar/avatar{{rand(1,46)}}.png" title="编码会馆">
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="media-heading mt-0 mb-1">
                                    <a href="{{url('article_details',['id'=>$topic->id])}}" style="font-weight: 500;" title="{{ $topic->article_title }}">
                                        {{ $topic->article_title }}
                                    </a>
                                    <a class="float-right" href="{{url('article_details',['id'=>$topic->id])}}">
                                        <span class="badge badge-secondary badge-pill">
                                            <i class="fa fa-eye"></i>
                                            {{ $topic->article_click }}
                                        </span>
                                        <span class="badge badge-secondary badge-pill">
                                            <i class="fa fa-thumbs-o-up"></i>
                                            @if ( $topic->goodlike > 100)
                                            100+
                                            @else
                                            {{ $topic->goodlike  }}
                                            @endif
                                        </span>
                                    </a>

                                </div>
                                <small class="media-body meta text-secondary">
                                    <a class="text-secondary" href="{{url('article',['nav_id'=>$topic->nav_id])}}" title="{{ $topic->nav_name->nav_title }}">
                                        <i class="far fa-folder"></i> {{ $topic->nav_name->nav_title }}
                                    </a>
                                    <span> • </span>
                                    <a class="text-secondary" href="{{url('article_details',['id'=>$topic->id])}}" title="{{ $topic->article_title }}">
                                        <i class="far fa-user"></i>adminer
                                    </a>
                                    <span> • </span>
                                    <i class="far fa-clock"></i>
                                    <span class="timeago" title="最后活跃于： {{ $topic->created_at }}"> {{ $topic->created_at->diffForHumans() }} </span>
                                </small>

                            </div>
                        </li>
                        @if ( ! $loop->last)
                        <hr>
                        @endif
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
        <div class="col-sm-9 mt-3">
            <div class="bd-example" data-example-id="">
                <div class="card">
                    <div class="card-body">
                        <blockquote class="blockquote blockquote-primary mb-0">
                            <p>您必须遵守 署名-非商业性使用-相同方式共享 <a href="https://creativecommons.org/licenses/by-nc-sa/4.0" class="btn btn-link btn-success p-0" target="_blank">CC BY-NC-SA</a> 使用这篇文章</p>
                            <p>本文链接：<a href="{{$article_url}}" class="text-info" target="_blank">{{$article_url}}</a></p>
                            <footer class="blockquote-footer">转载注明出处：{{$configs['base.website_title']}}</footer>
                        </blockquote>
                        <blockquote class="blockquote blockquote-primary mb-0">
                            <div class="row">
                                <div class="col-sm-12"></div>
                                <div style="text-align:center;margin:auto">
                                    <!-- <img style="height: 150px;width: 150px;margin: 0 auto"  src="http://www.seedblog.cn/uploads/teng_ad/qrcode_for_gh_7a8bc85b3f32_258.jpg" />  -->
                                    <img style=" margin: 0 auto" src="/uploads/teng_ad/weixin.png" />

                                </div>
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::check())
    @include("home.comment.add-comment",['article_message'=>$article_message])
    @else
    <div class="row">
        <div class="col-sm-9 mt-3">
            <div class="card">
                <div class="card-body">
                    <a class="text-indigo-600 hover:text-indigo-900" href="{{ route('login') }}">登陆后方可评论！</a>
                </div>
            </div>
        </div>
    </div>
    @endif

    @include("home.comment.index",['article_message'=>$article_message])

</div>
<div class="modal-dialog modal-sm">

</div>
@endsection

@push('backend-register-js')
<!--TocHelper 是一款给文章自动生成目录及侧边栏目录滚动特效的插件-->
<link href="{{asset(__STATIC_HOME__)}}/toc-helper/css/toc-helper.css" rel="stylesheet" />
<script src="{{asset(__STATIC_HOME__)}}/toc-helper/js/toc-helper.min.js"></script>
<script>
    window._bd_share_config = {
        "common": {
            "bdSnsKey": {},
            "bdText": "分享到新浪微博",
            "bdMini": "1",
            "bdMiniList": ["bdxc", "tqf", "douban", "bdhome", "sqq", "thx", "ibaidu", "meilishuo", "mogujie", "diandian", "huaban", "duitang", "hx", "fx", "youdao", "sdo", "qingbiji", "people", "xinhua", "mail", "isohu", "yaolan", "wealink", "ty", "iguba", "fbook", "twi", "linkedin", "h163", "evernotecn", "copy", "print"],
            "bdPic": "",
            "bdStyle": "1",
            "bdSize": "32"
        },
        "share": {}
    };
    with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        var editor = $("#test-editor");
        if (editor.length) {
            markdown();
        } 

        $('.carousel').carousel({
          interval: 2000
        })
    });

    function enkey_search() {
        if (event.keyCode != 13) {
            return;
        }
        search_article();
    }

    function search_article() {

        // 取得要提交页面的URL地址
        var url = "{{{url('article')}}}";
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
                    tocFixed: false,
                    showBefore: function() {
                        scroll.classList.remove('col-sm-12')
                    },
                    hiddenAfter: function() {
                        scroll.classList.add('col-sm-12')
                    }
                })
                tocHelper.reset()


            } else {
                const scroll = document.querySelector('#scroll')
                const tocHelper = new TocHelper({
                    dom: 'div[data-toc]',
                    offsetBody: document.querySelector('#scroll'),
                    tocFixed: false,
                    showBefore: function() {
                        scroll.classList.remove('col-sm-12')
                    },
                    hiddenAfter: function() {
                        scroll.classList.add('col-sm-12')
                    }
                })
                tocHelper.reset()
            }

            const switchBtn = function() {
                scroll.classList.contains('normal') ? (scroll.classList.remove('normal'), scroll.classList.add('scroll')) : (scroll.classList.add('normal'), scroll.classList.remove('scroll'))
                tocHelper.megre({
                    offsetBody: document.querySelector('#scroll')
                }).reload()
            }

            const togger = function() {
                tocHelper.togger()
            }

        });
    }

    $("#submit_msg").click(function() {
        var msg_content = $("#msg_content").val();
        var msg_blog_name = $("input[name='msg_blog_name']").val();
        var msg_blog_link = $("input[name='msg_blog_link']").val();
        var msg_blog_contact = $("input[name='msg_blog_contact']").val();
        var foreign_id = "{{$article_result->id}}";
        var url = "{{url('article_msg')}}";
        $.ajax({
            url: url,
            dataType: "json",
            data: {
                msg_content: msg_content,
                msg_blog_name: msg_blog_name,
                msg_blog_link: msg_blog_link,
                msg_blog_contact: msg_blog_contact,
                foreign_id: foreign_id,
                msg_type: 1
            },
            type: "post",
            beforeSend: function() {
                var index = layer.load(1, {
                    shade: [0.1, '#fff'] //0.1透明度的白色背景
                });
            },
            success: function(data) {
                layer.closeAll();
                if (data.status == 0) {
                    layer.msg(data.msg);
                } else if (data.status == -1) {
                    layer.msg(data.msg);
                    location.href = "{{ asset('login') }}";

                } else {
                    var msg_div = data.result;
                    append_msg_content(msg_div);
                }

            },
            error: function(data) {
                layer.closeAll();
                if (data.responseJSON.errors) {
                    var get_name = ['msg_content'];
                    var lenght = get_name.length;
                    var err_msg = data.responseJSON.errors;

                    // console.log(err_msg);return false;
                    for (var i = 0; i < lenght; i++) {
                        var err_name = get_name[i];
                        if (err_msg[err_name]) {
                            layer.msg(err_msg[err_name][0]);
                            break;
                        }
                    }
                } else {
                    layer.msg('提交失败,请重试');
                }
            }
        });
    });

    function subemail(id) {
        var url = "{{url('article_sub')}}";
        $.ajax({
            url: url,
            dataType: "json",
            data: {
                id: id
            },
            type: "post",
            success: function(data) {
                layer.closeAll();
                if (data.status) {
                    layer.msg(data.msg);

                } else if (data.status < 0) {
                    layer.msg(data.msg);
                    self.location.href = '/login';

                } else {
                    layer.msg(data.msg);
                }

            },
            error: function(data) {
                layer.closeAll();

            }
        });
    }

    function favorites(id) {
        var url = "{{url('article_favorite')}}";
        $.ajax({
            url: url,
            dataType: "json",
            data: {
                id: id
            },
            type: "post",
            success: function(data) {
                layer.closeAll();
                if (data.status) {
                    layer.msg(data.msg);

                } else if (data.status < 0) {
                    layer.msg(data.msg);
                    self.location.href = '/login';

                } else {
                    layer.msg(data.msg);
                }

            },
            error: function(data) {
                layer.closeAll();

            }
        });
    }

    function goodlike(id) {
        var url = "{{url('article_like')}}";
        $.ajax({
            url: url,
            dataType: "json",
            data: {
                id: id
            },
            type: "post",
            success: function(data) {
                layer.closeAll();
                if (data.status) {
                    layer.msg(data.msg);
                    $('#goodlike').html(data.goodlike);
                } else {
                    layer.msg(data.msg);

                }

            },
            error: function(data) {
                layer.closeAll();

            }
        });

    }

    function append_msg_content(msg_div) {
        var msg_board = $("#msg_board");
        msg_board.prepend(msg_div);
        //留言条数增加
        var msg_total = $("input[name='msg_total']").val();
        var total_number = parseInt(msg_total) + 1;
        $("input[name='msg_total']").val(total_number);
        var msg_record = "留言条数·" + total_number;
        $("#msg_record").html(msg_record);
    }

    function addBookmark(url, title) {
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
</script>

<script type="text/javascript">
    var ua = navigator.userAgent.toLowerCase();
    var copy_url = "{{$article_url}}";
    var author = "{{$configs['user_info.full_name']}}";
    var site_name = "{{$configs['base.website_title']}}";
    if (window.ActiveXObject) {
        /* 兼容IE */
        document.body.oncopy = function() {
            event.returnValue = false;
            var selectedText = document.selection.createRange().text;
            var pageInfo = '<br>---------------------<br>著作权归作者所有。<br>' +
                '非商业转载请注明出处。<br>' +
                '作者：' + author + '<br> 源地址：' + copy_url +
                '<br>来源：' + site_name + '<br>© 本文为' + site_name + '「' + author + '」的原创文章，遵循 CC BY-NC-SA 版权协议，转载请附上原文出处链接及本声明。';
            clipboardData.setData('Text', selectedText.replace(/\n/g, '<br>') + pageInfo);
        }
    } else {
        function addCopyRight() {
            var body_element = document.getElementsByTagName('body')[0];
            var selection = window.getSelection();
            var pageInfo = '<br>---------------------<br>著作权归作者所有。<br>' +
                '非商业转载请注明出处。<br>' +
                '作者：' + author + '<br> 源地址：' + copy_url +
                '<br>来源：' + site_name + '<br>© 本文为' + site_name + '「' + author + '」的原创文章，遵循 CC BY-NC-SA 版权协议，转载请附上原文出处链接及本声明。';
            var copyText = selection.toString().replace(/\n/g, '<br>') + pageInfo; // Solve the line breaks conversion issue
            var newDiv = document.createElement('div');
            newDiv.style.position = 'absolute';
            newDiv.style.left = '-99999px';
            body_element.appendChild(newDiv);
            newDiv.innerHTML = copyText;
            selection.selectAllChildren(newDiv);
            window.setTimeout(function() {
                body_element.removeChild(newDiv);
            }, 0);
        }
        document.oncopy = addCopyRight;
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
    //右侧
    (window.slotbydup = window.slotbydup || []).push({
        id: "u6554820",
        container: "_9u5ituvlffw",
        async: true
    });
    //底部
      (window.slotbydup = window.slotbydup || []).push({
        id: "u6554822",
        container: "_h1vg9vb3rbh",
        async: true
    });
 
   //头部
   (window.slotbydup = window.slotbydup || []).push({
        id: "u6575126",
        container: "_2sl288kbf0g",
        async: true
    });
    //wap tag_comment
    (window.slotbydup = window.slotbydup || []).push({
        id: "u6587097",
        container: "_t0wrm8shfrs",
        async: true
    });
</script>
@endpush