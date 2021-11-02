@extends('home.main')
@section('title','小程序') 
@section('content')
    <!--引入图片放大的CSS-->
    <link href="{{asset(__STATIC_HOME__)}}/assets/fancybox/jquery.fancybox.min.css" rel="stylesheet" />
    <style>
        .photo-img {
            height: 320px;
            background-position: 50%;
            /* background-size: cover; */
            text-align: center;
            border-radius: 12px 12px 0 0;
        }
    </style>
    <!-- 图片放大所需的JS-->
    <script src="{{asset(__STATIC_HOME__)}}/assets/fancybox/jquery.fancybox.min.js"> </script>   
    <div class="container pt-5">
        <div class="title"> 
        </div>
        <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-trail breadcrumbs">
                        <ul class="trail-items breadcrumb" style="background-color: #ffff;">
                            <li class="trail-item trail-begin"><a href="/"><i class="fa fa-home" aria-hidden="true"></i>首页 >> </a></li>
                            <li class="trail-item trail-end active"> 小程序 </li>
                        </ul>
                    </div>
                </div>
         </div>
         @foreach($photo_result as $v) 
                <div class="jumbotron" style="background-color:#ffff" id="photo_group">
                    
                        <div class="row no-gutters"> 
                            <div class="col-md-4"> 
                                <a no-pjax href="{{asset(__STATIC_UPLOADS__)}}/{{$v->photo_img}}" data-fancybox="gallery" data-caption="{{asset(__STATIC_UPLOADS__)}}/{{$v->photo_img}}" data-type="image">
                                    <div class="photo-img" data-background="image" style="background-image: url('{{asset(__STATIC_UPLOADS__)}}/{{$v->photo_img}}');"></div>
                                </a>
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$v->photo_title}}</h5> 
                                <p class="card-text">
                                {{$v->photo_desc}}
                                </p> 
                                <div class="col-sm-12 m-2">
                                    @php
                                        $tags = explode(',',$v->photo_tag);
                                    @endphp
                                    @foreach($tags as $k => $tag)
                                        <span class="badge badge-success badge-pill">{{$tag}}</span>
                                    @endforeach
                                </div>  
                                <p class="card-text"><small class="text-muted">更新时间:{{$v->updated_at->diffForHumans()}}</small></p> 
                                <a no-pjax href="{{asset(__STATIC_UPLOADS__)}}/{{$v->photo_img}}" data-fancybox="gallery" data-caption="{{asset(__STATIC_UPLOADS__)}}/{{$v->photo_img}}" data-type="image" class="btn btn-primary">预览</a>
                            </div>
                            </div>
                        </div>
                    
                </div>
            @endforeach
 
     
        <div class="row">
            <div class="col-sm-12">
                <div class="pagination-area">
                    {{$photo_result->onEachSide(1)->links('vendor.pagination.default')}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend-register-js')
<script>
    $(function () {
        var photo_group = $('photo_group');
            if(photo_group.length){
                photo();
            }
    });
    
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
</script>    
@endpush    