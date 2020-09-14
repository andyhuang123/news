@extends('layouts.app')
@section('title', '错误')

@section('content')
  <div class="card">
    <div class="card-header">错误</div>
    <div class="card-body text-center">
     
      <a class="btn btn-primary" href="{{ route('home.index') }}">返回首页</a>
    </div>
  </div>
@endsection
