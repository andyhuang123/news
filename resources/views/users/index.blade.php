 
@extends('home.main')

@section('title','用户中心')

@section('content')
 <div class="container pt-5">
         <div class="title"> 
            <!--<blockquote class="blockquote text-right">-->
            <!--    <p class="mb-0"> </p>-->
            <!--    <footer class="blockquote-footer"> -->
            <!--        <cite title="Source Title"> </cite>-->
            <!--    </footer>-->
            <!--</blockquote>-->
        </div> 
        <div class="col-sm-3" style="max-width:100%">
             <div class="card card-profile">
                    <div class="card-cover" style="background-image: url('{{processing_files($configs['user_info.background'])}}')">
                    </div>
                    <div class="card-avatar border-white">
                        <a href="javascript:void(0);">
                            <img src="{{$info->avatar}}" alt="..." width="100" >
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">
                            {{$info->username}}
                        </h4>
                        <h6 class="card-category">
                            {{$info->email}}
                        </h6> 
                        <p class="card-description">
                            个人信息
                        </p>
                    </div>
                    
                </div>
            </div>
        <div class="col-sm-9" style="max-width:100%">  
             <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul id="tabs" class="nav nav-tabs" role="tablist"> 
                                <li class="nav-item">
                                     我的收藏
                                </li> 
                        </ul>
                    </div>
                </div>
                   <div class="row">   
                     
                     @forelse($favorites as $key => $value)
                            <div class="col-md-4 mb-2">
                                    <div class="info border">
                                        <div class="icon icon-primary">
                                           <a href="{{url('article_details',['id'=>$value->article_id])}}">
                                            <i class="fa fa-newspaper-o"></i>
                                            </a>
                                        </div>
                                        <div class="description"> 
                                            <h4 class="info-title">
                                                <a href="{{url('article_details',['id'=>$value->article_id])}}">
                                                {{str_limit($value->article->article_title,25,'....')}}
                                                </a>
                                            </h4>
                                            <p> 
                                             <a href="{{url('article_details',['id'=>$value->article_id])}}"> 
                                                {{str_limit($value->article->article_describe,25,'....')}}
                                             </a>
                                            </p>
                                            
                                        </div> 
                                    </div>
                                
                            </div> 
                      @empty
                        <p>没有相关数据</p>
                      @endforelse 
                       
                  </div> 
                </div>   

          </div> 
   
@endsection
 


