@extends('layouts.app')

@section('title', 'php漫游指南-404 NOT Found')
 
@section('body') 
      <style>
          .row {
                 margin: auto;
                display: block;
                text-align: center;
                font-size: 90px;
                line-height: 250px;
                font-family: cursive;
                color: #382e2e;
          }
      </style>
      <div class="card">
        <div class="card-header"></div>
        <div class="card-body text-center"> 
          <a class="btn btn-primary" href="{{ route('home.index') }}">返回首页</a>
        </div>
      </div>
      <div class="row" >404错误</div>
    
@endsection
