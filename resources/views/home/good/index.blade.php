@extends('home.main')
@section('title','福利')
@section('content')
    <div class="container pt-5">
        <div class="title"> 
        </div> 
        <div class="container">
            <div class="title">
                <h3>优惠券 <br> </h3>
            </div>
            <div class="container">
                <div class="row"> 
                @if(count($hotads))
                    @foreach($hotads as $ad)
                        <div class="col-sm-4"> 
                                <div class="card">
                                    <div class="card-body"> 
                                        <div class="media mt-2">
                                        <div class="media-left media-middle mr-2 ml-1">
                                            <a class="media mt-2" href="{{$ad->click_url}}" target="_blank">
                                            <img src="{{$ad->pict_url}}" width="120px" height="120px" class="media-object">
                                            </a>
                                        </div>
                                        <div class="media-body"> 
                                            <small class="media-heading text-secondary" style="font-size: 1em;">
                                                <h6 class="card-title" style="font-size:14px"><i class="nc-icon nc-planet" aria-hidden="true"></i> {{$ad->short_title}}</h6>
                                                @if(isset($ad->coupon_click_url)) 
                                                    <div style="margin-top:15px">
                                                        <a href="{{$ad->coupon_click_url }}"  title="{{$ad->title}}" target="_blank">
                                                            <span class="label label-danger" style="font-size: 18px;border-radius: 5px;">
                                                            立即领取      ¥{{$ad->coupon_amount}}券
                                                            </span>
                                                        </a> 
                                                    </div> 
                                                    <div style="margin-top:20px">
                                                        <a href="{{$ad->click_url }}"  title="{{$ad->title}}" target="_blank">
                                                            <span class="label label-danger" style="font-size: 18px;border-radius: 5px;">
                                                            点击购买
                                                            </span>
                                                        </a> 
                                                    </div> 

                                                @else
                                                    <h4>
                                                        <a href="{{$ad->click_url }}"  title="{{$ad->title}}" target="_blank">
                                                            <span class="label label-danger" style="font-size: 18px;border-radius: 5px;">
                                                            点击购买
                                                            </span>
                                                        </a> 
                                                    </h4> 
                                                @endif
                                            
                                            </small> 
                                        </div>  
                                        </div>
                                </div>     
                            </div>     
                        </div>                   
                    @endforeach    
                  @else
                     <div class="empty-block">暂无数据 ~_~ </div>
                  @endif 
                </div>
            </div>
        </div>
       
        <!--分页开始-->
        <div class="pagination-area">
               
        </div>
    </div>
@endsection