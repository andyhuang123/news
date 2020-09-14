@extends('home.main')
@section('title','文章列表')
@section('content')
<style>
    .card img {
        max-width: 100%;
        height: auto;
        border-radius: 12px 12px 12px 12px;
    }
    .ui.green.label, .ui.green.labels .label {
        background-color: #21ba45!important;
        border-color: #21ba45!important;
        color: #fff!important;   
    }
    
    .ui.red.label, .ui.red.labels .label {
        background-color: #ff0000!important;
        border-color: #ff0000!important;
        color: #fff!important;   
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
        color: #101010!important;
    }
    .fa, .fas {
        font-weight: 900;
    }
    .fa, .far, .fas {
        font-family: "Font Awesome 5 Free";
    }
    .fa, .fab, .fad, .fal, .far, .fas {
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
</style>
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
                                    <a class="nav-link {{ active_class( ! if_query('order', 'recent')) }}" href="{{ Request::url() }}?order=default">
                                       最新发布
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link {{ active_class(if_query('order', 'recent')) }}" href="{{ Request::url() }}?order=recent">
                                       最近活跃
                                    </a>
                                  </li>
                                </ul>
                         </div>
                      
                        <div class="card-body">
                             @if (count($show_article))
                                <ul class="list-unstyled"> 
                                    @foreach ($show_article as $topic)
                                       @if ($topic->tag =='ad')
                                            <li class="media">
                                                <div class="media-left">
                                                  <a href="{{url('article_details',['id'=>$topic->id])}}">
                                                    <img class="media-object img-thumbnail mr-3" style="width: 52px; height: 52px;" src="/uploads/{{$topic->ad_img}}" title="php漫游指南">
                                                  </a>
                                                </div> 
                                                <div class="media-body"> 
                                                  <div class="media-heading mt-0 mb-1">
                                                    <a href="{{url('article_details',['id'=>$topic->id])}}" style="font-weight: 500;" title="{{ $topic->article_title }}" target="_blank">
                                                       <span class="hide-on-mobile ui label status small red">广告</span> 
                                                        {{ $topic->article_title }}
                                                    </a> 
                                                    <a class="float-right" href="{{$topic->tag_url}}" target="_blank">
                                                              <span class="badge badge-secondary badge-pill">
                                                             <i class="fa fa-newspaper-o"></i>查看详情</span>
                                                     </a> 
                                                  </div> 
                                                   <small class="media-body meta text-secondary">   
                                                        <i class="far fa-clock"></i>
                                                        <span class="timeago" title="最后活跃于：{{ $topic->created_at }}">{{ $topic->created_at->diffForHumans() }}</span>
                                                   </small>
                                                  
                                                </div>
                                              </li>
                                       @else
                                          <li class="media">
                                            <div class="media-left">
                                              <a href="{{url('article_details',['id'=>$topic->id])}}">
                                                <img class="media-object img-thumbnail mr-3" style="width: 52px; height: 52px;" src="/uploads/images/f3be6e538141993c909527c47a563450.jpg" title="php漫游指南">
                                              </a>
                                            </div>
                                    
                                            <div class="media-body">
                                               
                                              <div class="media-heading mt-0 mb-1">
                                                <a href="{{url('article_details',['id'=>$topic->id])}}" style="font-weight: 500;" title="{{ $topic->article_title }}" target="_blank">
                                                    <span class="hide-on-mobile ui label status small green">博客</span> 
                                                    {{ $topic->article_title }}
                                                </a>  
                                                <a class="float-right" href="{{url('article_details',['id'=>$topic->id])}}" target="_blank">
                                                      <span class="badge badge-secondary badge-pill"> <i class="fa fa-eye"></i> {{ $topic->article_click }} </span>
                                                 </a> 
                                                 <a href="javascript:void(0);" rel="tooltip" title="书签" class="btn btn-outline-neutral btn-round btn-just-icon" onclick='addBookmark("{{url('article_details',['id'=>$topic->id])}}")'>
                                                     <i class="fa fa-bookmark-o"></i>
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
                                       @endif  
                                
                                      @if ( ! $loop->last)
                                        <hr>
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
                            <h5><i class="fas fa-bullhorn card-announcement-animation"></i>   博客公告</h5>
                            <div class="row">
                                <div class="col-sm-12">
                                    @foreach($notice_list as $k => $v)
                                        <div class="alert alert-success alert-with-icon" data-notify="container"
                                            style="cursor: pointer;" data-toggle="modal" data-target="#notice{{$v->id}}">
                                            <div class="container">
                                                <div class="alert-wrapper" data-toggle="modal"
                                                    data-target="#notice{{$v->id}}">
                                                    <div class="message">
                                                        <i class="fas fa-lightbulb"></i>
                                                        {{$v->notice_title}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>    
                    
                    <div class="card ">
                        <div class="card-body">
                                <div class="col-sm-12 p-0">
                                    <div class="input-group">
                                        <input type="text" name="search_title" class="form-control" placeholder="搜索本站文章" onkeydown="enkey_search()">
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
                                        <p class="h5">微信公众号</p>
                                        <img style="height: 100%;width: 100%;" src="http://news.seedblog.cn/uploads/teng_ad/qrcode_for_gh_7a8bc85b3f32_258.jpg" > 
                                    </div> 
                          </div>
                   </div>
                    <div class="card ">
                      <div class="card-body">
                              <h5><i class="fas fa-history"></i> 热门文章 </h5>
                                <ul class="list-unstyled">
                                    @foreach($hot_article as $k => $v)
                                    
                                      <li class="nav-item">  
                                            <a href="{{url('article_details',['id'=>$v->id])}}"
                                                   class="text-muted">{{$v->article_title}}</a> 
                                            <a href="javascript:void(0);" class="btn btn-sm {{$button_color[$k]}} btn-link" onclick='addBookmark("{{url('article_details',['id'=>$v->id])}}")'>
                                                <i class="fa fa-bookmark-o" aria-hidden="true"></i> {{$v->article_like}}
                                            </a>
                                            <a href="javascript:void(0);" class="btn btn-sm {{$button_color[$k]}} btn-link">
                                                <i class="far far fa-kiss-beam" aria-hidden="true"></i> {{$v->article_click}}
                                            </a>
                                            <hr>
                                        <li>
                                    @endforeach
                                </ul>  
                      </div>
                    </div>
                  
                    <div class="card ">
                        <div class="card-body">
                        <div class="col-sm-12 p-0">
                            <div class="sentence"><strong>每日一句</strong>
                                <h2>{{date('Y年m月d日')}} {{$week_list[date('w')]}}</h2>
                                <p id="hitokoto"></p>
                            </div>
                            </div>  
                        </div>
                    </div> 
                    <div class="card ">
                        <div class="card-body">
                            <div class="col-sm-12 p-0">
                                    <h5><i class="fas fa-chart-line"></i>本站统计 </h5>
                                    <ul class="list-unstyled">
                                        <li style="margin-bottom:5px">
                                            <b>{{$show_article->total()}}</b>篇文章
                                        </li> 
                                        <li style="margin-bottom:5px">
                                            <b>{{$article_click}}</b>次阅读
                                        </li> 
                                        <li style="margin-bottom:5px">
                                            <b>{{$total_msg}}</b>条留言
                                        </li>
                                    </ul>
                            </div>  
                        </div>
                    </div> 
                    
                    <div class="card ">
                          <div class="card-body">
                              <h5> <i class="fa fa-rss-square" aria-hidden="true"></i> 邮箱订阅 </h5> 
                              <div class="col-sm-12 mt-2 p-0">  
                                    <!--订阅start-->
                                    <div class="col-sm-12 border p-2">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" placeholder="输入邮箱订阅我">
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
                                    <!--订阅end--> 
                         </div>  
                      </div>
                   </div>
                </div>
            </div> 
            <!--所有文章结束-->
            
             <!--最新发布开始-->
            <div class="row mb-5">
                <div class="col-lg-9 col-md-9 topic-list">
                <div class="card ">
                    <div class="card-body">
                    <div class="title">
                        <h5> <i class="fa fa-heart-o" aria-hidden="true"></i>   猜你喜欢 <br> </h5>
                    </div>
                    <div class="row ">
                        @foreach($random_article as $k => $v)
                            <div class="col-md-6">
                                <div class="card" data-color="{{$background_color[$k]}}" data-background="color">
                                    <div class="card-body text-center">
                                        <h6 class="card-category">
                                            <i class="fa fa-tree" aria-hidden="true"></i>
                                            {{$configs['base.website_title']}} -- {{$v->nav_name->nav_title}}
                                        </h6>
                                        <h5 class="card-title" style="height: 60px;">
                                            <a href="{{url('article_details',['id'=>$v->id])}}">
                                                {{$v->article_title}}
                                            </a>
                                        </h5>
                                        <p class="card-description" style="height: 70px;">
                                            {{str_limit($v->article_describe,80)}}
                                        </p>
                                        <div class="card-footer text-center">
                                            <a href="javascript:void(0);" rel="tooltip" title="书签"
                                               class="btn btn-outline-neutral btn-round btn-just-icon"
                                               onclick="addBookmark('http://qqphp.com')"><i
                                                        class="fa fa-bookmark-o"></i></a>
                                            <a href="{{url('article_details',['id'=>$v->id])}}"
                                               class="btn btn-neutral btn-round"><i class="fa fa-newspaper-o"></i>
                                                阅读</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-md-3 sidebar">
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
                </div>
            </div>
            <!--最新发布结束-->
        </div> 
</div>    
        <!-- 公告弹出 modal -->
        @foreach($notice_list as $k => $v)
            <div class="modal fade" id="notice{{$v->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
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
    <!-- 一言插件 -->
    <script src="https://v1.hitokoto.cn/?encode=js&select=%23hitokoto&v={{time()}}" defer></script>
    {{--收藏--}}
    <script type="text/javascript">
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
                data: {email_name: email_name},
                type: "post",
                beforeSend: function () {
                    var index = layer.load(1, {
                        shade: [0.1, '#fff'] //0.1透明度的白色背景
                    });
                },
                success: function (data) {
                    layer.closeAll();
                    layer.msg(data.msg);
                },
                error: function (data) {
                    layer.closeAll();
                    if(data.responseJSON.errors){
                        var get_name = ['email_name'];
                        var lenght = get_name.length;
                        var err_msg = data.responseJSON.errors;
                        for(var i = 0;i<lenght;i++){
                            var err_name = get_name[i];
                            if(err_msg[err_name]){
                                layer.msg(err_msg[err_name][0]);
                                break;
                            }
                        }
                    }else{
                        layer.msg('订阅失败,请重试');
                    }
                }
            });
        }
        function enkey_search(){
            if (event.keyCode != 13) {
                  return;
            } 
            search_article();
        }
        function search_article(){
          
            // 取得要提交页面的URL地址
            var url = "{{{url()->current()}}}";
            // 取得要提交的参数
            var search_title = $("input[name='search_title']").val();

            // 创建Form
            var form = $('<form id="search_form"></form>');
            form.attr('action', url);        // 设置Form表单的action属性
            form.attr('method', 'get');        // 设置Form表单的method属性
            var csrf = '@csrf';
            form.append(csrf);
            // 创建input
            var input_title = $('<input type="text" name="search_title" />');
            input_title.attr('value', search_title);     // 设置input的value属性

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
            form.attr('action', url);        // 设置Form表单的action属性
            form.attr('method', 'get');        // 设置Form表单的method属性
            var csrf = '@csrf';
            form.append(csrf);
            // 创建input
            var input_tag = $('<input type="text" name="tag_content" />');
            input_tag.attr('value', $tag_content);     // 设置input的value属性

            // 把input添加到表单中
            form.append(input_tag);

            // 把表单添加到document.body中（不然在谷歌浏览器中会报错）
            $(document.body).append(form);

            // 提交表单（当然也可以通过AJAX来提交了，只要你喜欢）
            form.submit();
            $("#tag_form").remove();
            return false;
        }
    </script>
@endsection