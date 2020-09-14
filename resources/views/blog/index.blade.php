
@extends('layouts.app')

@section('title', '文章列表')
 
@section('body')  

<div class="row mb-5">
    
      <div class="col-lg-9 col-md-9 topic-list">
    
          <div class="alert alert-info" role="alert">
             php  ：laravel-admin
          </div>
         
            <div class="card ">
                    <div class="card-header bg-transparent">
                            <ul class="nav nav-pills">
                              <li class="nav-item">
                                <a class="nav-link" href="{{ Request::url() }}?order=default">
                                   最新发布
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="{{ Request::url() }}?order=recent">
                                   最近更新
                                </a>
                              </li>
                            </ul>
                      </div>
                     <div class="card-body">
                          {{-- 文章列表 --}} 
                          @include('blog.list', ['blogs' => $blogs]) 
                          {{-- 分页 --}}
                            <div class="mt-5">
                              {!! $blogs->appends(Request::except('page'))->render() !!} 
                            </div>
                    </div>
              </div>
          
      </div>

      <div class="col-lg-3 col-md-3 sidebar">
        @include('blog.sidebar')
      </div>
      
  
</div>

@endsection