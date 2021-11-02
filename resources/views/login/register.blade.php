@extends('layouts.app')

@section('title', '注册')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
<style>
    .fa {
        width: auto;
        text-align: center;
    }
</style>
@endsection

@section('body')
<!-- Navbar will come here -->
<nav class="navbar navbar-transparent" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <!--<a class="navbar-brand" href="/"><i class="fa fa-paper-plane"></i> </a>-->
        </div>
    </div>
</nav>
<!-- end navbar -->

<div class="container">
    <!-- you can use the class main-raised if you want the main area to be as a page with shadows -->
    <div class="main">
        <div class="container">

            <!-- here you can add your content -->
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="card card-login">
                        <div class="card-header">
                            <div class="logo">
                                <a href="{{ asset('/') }}">
                                     <i class="fa fa-smile-o"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons text-primary">face</i>
                                    </span>
                                    <input type="text" class="form-control" name="username" placeholder="Username" maxlength="20" required="" autofocus="">
                                </div>
                                 <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons text-primary">email</i>
                                    </span>
                                    <input type="email" class="form-control" name="email" placeholder="email"  required="" autocomplete="email">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons text-primary">lock_outline</i>
                                    </span>
                                    <input type="password" class="form-control" name="password" placeholder="Password" maxlength="40" required="">
                                </div>
                                <p class="text-center">
                                    <button type="submit" class="btn btn-round btn-primary">注册</button>
                                </p>
                                <p class="text-center clearfix">
                                    <a href="{{ asset('login') }}" class="pull-right">登录</a>
                                </p>
                                @if (count($errors) > 0)
                                    <div id="alert-danger" class="alert alert-danger">
                                        <div class="container-fluid">
                                          <div class="alert-icon">
                                            <i class="material-icons">error_outline</i>
                                          </div>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                          </button>
                                          @foreach ($errors->all() as $error)
                                          {{ $error }}<br>
                                          @endforeach
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
