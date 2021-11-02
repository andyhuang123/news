@extends('home.main')
@section('title','相册详情')
@push('scripts')
<!-- 图片放大所需的JS-->
<script src="{{asset(__STATIC_HOME__)}}/assets/fancybox/jquery.fancybox.min.js"> </script>  
@endpush
@section('content')
    <!--引入图片放大的CSS-->
    <link href="{{asset(__STATIC_HOME__)}}/assets/fancybox/jquery.fancybox.min.css" rel="stylesheet" />
    <div class="container pt-5">
        <div class="title"> 
        </div> 
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h3>{{$details_result->photo_title}}</h3>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($photo_result as $v)
                <div class="col-sm-2">
                    <div class="card mb-3" id="photo_group">
                        <a no-pjax href="{{processing_files($v)}}" data-fancybox="gallery" data-caption="{{$v}}" data-type="image">
                            <div class="photo-img" data-background="image" style="background-image: url('{{processing_files($v)}}');"></div>
                        </a>
                        <div class="card-body p-0 text-center">
                            <h5 class="mt-2">{{date_conversion($details_result->updated_at)}}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
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