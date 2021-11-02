@extends('home.main')

@section('title','时间线')

@section('content') 
 <link rel="stylesheet" type="text/css" href="{{asset(__STATIC_HOME__)}}/assets/line/css/jquery.eeyellow.Timeline.css" /> 
 <script src="{{asset(__STATIC_HOME__)}}/assets/js/core/jquery.min.js" type="text/javascript"></script>
 <script type="text/javascript" src="{{asset(__STATIC_HOME__)}}/assets/line/js/jquery.eeyellow.Timeline.js"></script>
 <style>
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

<div class="container">
      <div class="title"></div> 
      <div class="row">
            <div class="col-sm-8">
                <div class="row"> 
                       <h3 style="margin:auto">博文纪要2022--未来</h3>
                       <div class="col-md-12">  
                            <div class="VivaTimeline" id="VivaTimeline"> 
                                <dl> 
                                    @foreach($show_article as $k => $v) 
                                        <dt>{{$v->created_at->format('Y-m')}}</dt>  
                                        <dd class=" @if($k%2==1) pos-left  @else pos-right  @endif clearfix"> 
                                                <div class="circ"></div>
                                                <div class="time" style="font-weight:bold">{{$v->created_at->format('m-d')}}</div>
                                                <div class="events">
                                                    <div class="events-header"> 
                                                        <a href="{{url('article_details',['id'=>$v->id])}}" target="_blank" style="font-weight:bold;"> 
                                                            {{$v->article_title}} 
                                                        </a>
                                                    </div>
                                                    <div class="events-body">
                                                        <div class="row">
                                                            <div class="col-md-6 pull-left"> 
                                                                <!--<img class="events-object img-responsive img-rounded" src="{{processing_files($configs['base.website_icon'])}}" /> -->
                                                            </div>
                                                            <div class="events-desc" >   
                                                                {{str_limit($v->article_describe,225)}}
                                                            </div> 
                                                        </div>
                                                        
                                                    </div> 
                                                </div>
                                        </dd>
                                    @endforeach 
                                </dl>
                            </div> 
                        </div> 
                </div>
                <!--分页开始-->
                <div class="pagination-area">
                    {{$show_article->onEachSide(1)->links('vendor.pagination.default')}} 
                </div>
            </div>
            <div class="col-sm-4">

                <div class="card mt-4">
                    <div class="card-body pt-2">
                    <div class="text-center mt-1 mb-0 text-muted">资源推荐</div>
                    <hr class="mt-2 mb-3"> 
                        <a class="media mt-1" href="/wiki">
                        <div class="media-body">
                            <span class="media-heading text-muted">wiki文档</span>
                        </div>
                        </a> 
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
                                    <p style="color: #212020;font-weight: 500;">{{$ad->title}}</p> 
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
                @if (count($hotads))
                <div class="card mt-4">
                    <div class="card-body active-users pt-2">
                    <div class="text-center mt-1 mb-0 text-muted">
                        <h4><i class="fas fa-history"></i> 实时热销榜</h4>
                    </div>
                    <hr class="mt-2">
                    @foreach($hotads as $k => $v) 
                        <a class="media mt-3" href="{{$v->click_url}}" target="_blank">
                        <div class="media-left media-middle mr-2 ml-1">
                            <img src="{{$v->pict_url}}" width="120px" height="120px" class="media-object">
                        </div>
                        <div class="media-body">
                            <small class="media-heading text-secondary" style="font-size: 1.1em;font-weight: 500;">
                                {{$v->title}} </br>
                                <h5>
                                    <span class="label label-danger" style="width: 100%;text-align: center;margin: 5px;border-radius: 5px;line-height: 25px;">
                                        立即购买
                                    </span>
                                </h5>
                            </small> 
                        </div> 
                        </a>
                    @endforeach
                    </div>
                </div>
                @endif

            </div> 
      </div>
</div> 
@endsection

@push('backend-register-js')

<script>
  
  $(function () {
        $('#VivaTimeline').vivaTimeline({
            carousel: true,
            carouselTime: 3000
        });  　  
  }); 
  
</script>
@endpush    