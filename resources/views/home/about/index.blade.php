@extends('home.main')
@section('title','关于我')
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
    .card .carousel .carousel-inner a {
        position: unset;  
        color: #FFFFFF !important;
    } 
    .card .carousel .carousel-control-next, .carousel-control-prev {
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
    .card .carousel .carousel-control-next, .carousel-control-prev {
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
</style>
    <div class="container pt-5">
        <div class="title"> 
            <!-- <blockquote class="blockquote text-right"></blockquote>  -->
        </div> 
        <div class="row">
            <div class="col-sm-3">
                <div class="card card-profile">
                    <div class="card-cover" style="background-image: url('{{processing_files($configs['user_info.background'])}}')">
                    </div>
                    <div class="card-avatar border-white">
                        <a href="javascript:void(0);">
                            <img src="/uploads/{{$configs['user_info.portrait']}}" alt="...">
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">
                            {{$configs['user_info.full_name']}}
                        </h4>
                        <h6 class="card-category">
                            {{$configs['user_info.occupation']}}
                        </h6>
                        <p class="card-description">
                            {{$configs['user_info.motto']}}
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="javascript:void(0);" class="btn btn-just-icon btn-outline-info" data-html="true" data-toggle="tooltip" data-placement="top"  data-clipboard-action="copy" data-clipboard-text="{{$configs['user_info.user_qq']}}" id="copy_qq">
                            <i class="fa fa-qq" aria-hidden="true"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-just-icon btn-outline-success" data-html="true" data-toggle="tooltip" data-placement="top" data-clipboard-action="copy" data-clipboard-text="{{$configs['user_info.user_wechat']}}" id="copy_wx">
                            <i class="fa fa-wechat" aria-hidden="true" data-clipboard-action="copy" data-clipboard-target="#copy_wx"></i>
                        </a>
                        <a href="https://github.com/andyhuang123" class="btn btn-just-icon btn-outline-success" data-html="true" data-toggle="tooltip" data-placement="top">
                             <i class="fa fa-github fa-fw" aria-hidden="true"></i>
                        </a> 
                        <a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=t4SCgYSHh4KDgffGxpnU2No" style="text-decoration:none;">
                        <img src="http://rescdn.qqmail.com/zh_CN/htmledition/images/function/qm_open/ico_mailme_22.png"/></a>
                    </div>
                </div>
                 
                <div class="card">
                       <div class="card-body"> 
                        <div id="demo" class="carousel slide" data-ride="carousel"> 
                            <!-- 指示符 -->
                            <ul class="carousel-indicators">
                                @if(count($ads))
                                    @foreach ($ads as $key=>$ad) 
                                    <li data-target="#demo" data-slide-to="{{$key}}"  @if($key==0) class="active" @endif></li> 
                                    @endforeach
                                @else
                                <li data-target="#demo" data-slide-to="0"  class="active"></li> 
                                @endif     
                            </ul>

                            <!-- 轮播图片 -->
                            <div class="carousel-inner">
                            @if(count($ads))
                                @foreach ($ads as $key=>$ad) 
                                    <div class="carousel-item @if($key==0)active @endif"> 
                                        <a href="{{$ad->click_url}}"  target="_blank">
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
            </div>
            <div class="col-sm-9">
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul id="tabs" class="nav nav-tabs" role="tablist">
                            @foreach($about_data as $key => $about)
                                <li class="nav-item">
                                    <a class="nav-link @if($key == 0) active @endif" data-toggle="tab" href="#a{{$about->id}}" role="tab">{{$about->about_title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div id="my-tab-content" class="tab-content">
                    @foreach($about_data as $key => $about)
                        @if($about->about_type == 1)
                            <div class="tab-pane @if($key == 0) active @endif" id="a{{$about->id}}" role="tabpanel">
                                @if($about->about_describe)
                                    <div class="container">
                                        <div class="bd-callout">
                                            <p>
                                                {{$about->about_describe}}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                <div class="description">
                                    @if(isset($about->article->articles_content))
                                        {!! $about->article->articles_content !!}
                                    @endif
                                </div>
                            </div>
                        @elseif($about->about_type == 2)
                            <div class="tab-pane @if($key == 0) active @endif" id="a{{$about->id}}" role="tabpanel">
                                @if($about->about_describe)
                                    <div class="container">
                                        <div class="bd-callout">
                                            <p>
                                                {{$about->about_describe}}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    @foreach($about->card1 as $card_key1 => $card1)
                                        <div class="col-md-4 mb-2">
                                            <div class="info border">
                                                <div class="icon icon-primary">
                                                    <i class="@if(strpos($card1->card_icon,' ')) {{$card1->card_icon}} @else fa {{$card1->card_icon}} @endif"></i>
                                                </div>
                                                <div class="description">
                                                    <h4 class="info-title">{{$card1->card_title}}</h4>
                                                    <p>
                                                        {{$card1->card_content}}
                                                    </p>
                                                </div>
                                                <div class="container">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @elseif($about->about_type == 3)
                            <div class="tab-pane @if($key == 0) active @endif" id="a{{$about->id}}" role="tabpanel">
                                @if($about->about_describe)
                                    <div class="container">
                                        <div class="bd-callout">
                                            <p>
                                                {{$about->about_describe}}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    @foreach($about->card2 as $card_key2 => $card2)
                                        <div class="col-md-3 mb-2">
                                            <div class="card card-pricing" data-background="image" style="background-image: url('{{processing_files($card2->card_background)}}')">
                                                <div class="card-body" style="min-height: 0px;padding-top: 0px;padding-bottom: 0px;">
                                                    <div class="card-icon">
                                                        <i class="@if(strpos($card2->card_icon,' ')) {{$card2->card_icon}} @else fa {{$card2->card_icon}} @endif"></i>
                                                    </div>
                                                    <h3 class="card-title">
                                                        {{$card2->card_title}}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            copyqq();
            copywx();
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
    </script>
@endsection