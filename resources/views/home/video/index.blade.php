@extends('home.main')

@section('title','视频列表')

@push('scripts') 
<link rel="stylesheet" href="{{asset(__STATIC_HOME__)}}/assets/video_theam/css/style.css">
<link href="{{asset(__STATIC_HOME__)}}/assets/video_theam/owl-carousel/owl.carousel.css" rel="stylesheet">
<link href="{{asset(__STATIC_HOME__)}}/assets/video_theam/owl-carousel/owl.theme.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset(__STATIC_HOME__)}}/assets/video_theam/jquery/font-awesome.4.6.0.css">
<style>
    .zoom-container a {
        display: block;
        position: absolute;
        top: -100%;
        opacity: 0;
        left: 0;
        bottom: 0;
        right: 0;
        text-align: center !important;
        color: inherit;
    }
    .fa { 
        width: auto;
        text-align: center;
    }
    .card .card-text {
        font-size: 15px;
        color: #66615b;
        padding-bottom: 0px;
        padding-top: 10px;
    }
</style> 
@endpush 

@section('content')

<div class="container pt-5"> 
    <div class="title"> </div>   
     <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb" style="background-color: #ffff;">
                    <li class="trail-item trail-begin"><a href="/"><i class="fa fa-home" aria-hidden="true"></i>首页 >> </a></li> 
                    <li class="trail-item trail-end active">视频列表 </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">  
            <div class="row row-cols-1 row-cols-md-3">
            @foreach($video_result as $v) 
                <div class="col-sm-3"> 
                    <div class="card"> 
                        <img src="/uploads/{{$v->video_img}}" class="card-img-top" alt="{{$v->video_title}}" style="position:absolute;opacity: 0.7;z-index:0">
                        <div class="card-body" style="z-index: 999;">
                            <a href="{{url('video_details',['vid'=>$v->id])}}"> 
                                <h5 class="card-title" style="color:#fdf7e6;">{{$v->video_title}}</h5>
                            </a> 
                            <p class="card-text">  
                                <a class="text-secondary" href="{{url('video_details',['vid'=>$v->id])}}" title="{{$v->video_title}}">
                                    <i class="far fa-user"></i> adminer
                                </a> 
                                </p>
                        </div>
                        <div class="card-footer text-center" style="z-index: 999;">
                            <a href="{{url('video_details',['vid'=>$v->id])}}">
                                <i class="far fa-play-circle" aria-hidden="true" style="font-size: 3.8rem;color: #0dc55b;"></i>
                            </a> 
                        </div>
                        <div class="card-footer" style="z-index: 999;">
                            <i class="far fa-clock"></i>
                                <small class="text-muted">{{$v->created_at->diffForHumans()}}</small>
                                <span> • </span> 
                                <i class="fa fa-eye"></i> {{$v->video_click}}
                        </div>
                    </div>
                </div> 
            @endforeach
            
        </div> 
        <div class="row">
            <div class="col-sm-12">
                <div class="pagination-area">
                    {{$video_result->onEachSide(1)->links('vendor.pagination.default')}}
                </div>
            </div>
        </div>
                    
               
      
    </div>
</div>

@endsection

@push('backend-register-js')
<script src="{{asset(__STATIC_HOME__)}}/assets/video_theam/owl-carousel/owl.carousel.js"></script>
<script>
    $(document).ready(function() {
      $("#owl-demo").owlCarousel({
        autoPlay: 3000,
        items : 5,
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [979,4]
      });

    });
  </script>
@endpush
