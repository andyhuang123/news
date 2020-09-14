@extends('home.main')
@section('title','福利')
@section('content')
    <div class="container pt-5">
        <div class="title"> 
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h3>福利列表
                        <br>
                        <!--<small>折戟沉沙铁未销,自将磨洗认前朝。东风不与周郎便,铜雀春深锁二乔。--《赤壁》(唐/杜牧)</small>-->
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">  
              @foreach($list as $vo)
               <div class="col-sm-3">
                    <div class="card mb-3">  
                              <a href="{{$vo->href}}" target="_blank">
                              <img src="http://www.seedblog.cn/uploads/{{$vo->img_url}}" alt="{{$vo->title}}" width="100%"> 
                              </a>
                    </div>
               </div> 
              @endforeach
             
        </div>
        <!--分页开始-->
        <div class="pagination-area">
               {{$list->onEachSide(1)->links('vendor.pagination.default')}}
      
        </div>
    </div>
@endsection