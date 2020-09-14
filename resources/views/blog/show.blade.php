@extends('layouts.app')

@section('title', '详情')

@section('body')  

<div class="row">

<div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
  <div class="card ">
    <div class="card-body">
      <div class="text-center">
        作者：coding
      </div>
      <hr>
      <div class="media">
        <div align="center">
          <a href="#">
            <img class="thumbnail img-fluid" src="/uploads/images/f3be6e538141993c909527c47a563450.jpg" width="300px" height="300px">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
  <div class="card">
    <div class="card-body">
      <h1 class="text-center mt-3 mb-3">
        {{ $info->article_title }}
      </h1>

      <div class="article-meta text-center text-secondary">
        {{ $info->created_at->diffForHumans() }}
        ⋅
        <i class="far fa-comment"></i>
           0
      </div>

      <div class="topic-body mt-4 mb-4">
        {!! $info->article_content !!}
      </div>

      @can('update', $info)
        <div class="operate">
          <hr>
          <a href="" class="btn btn-outline-secondary btn-sm" role="button">
            <i class="far fa-edit"></i> 编辑
          </a>
          <form action="" method="post"
                style="display: inline-block;"
                onsubmit="return confirm('您确定要删除吗？');">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-outline-secondary btn-sm">
              <i class="far fa-trash-alt"></i> 删除
            </button>
          </form>
        </div>
      @endcan

    </div>
  </div>

  {{-- 用户回复列表 --}}
  <div class="card topic-reply mt-4">
      <div class="card-body">
         
      </div>
  </div>

</div>
</div>

@endsection