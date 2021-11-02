<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="{{url('/')}}" rel="tooltip" data-placement="bottom">
                <span style="font-size:16px;"><img src="/img/logo.svg" width="25px" height="25px" /></span>
                {{$configs['base.website_title']}}
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
                @foreach($nav_list as $nav)
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false">
                        {{$nav->nav_title}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-success">
                        @foreach($nav->son_nav as $son_nav)
                        <a href="{{url($son_nav->nav_route,['nav_id'=>$son_nav->id])}}" class="dropdown-item">
                            {{$son_nav->nav_title}}
                        </a>
                        @endforeach
                    </div>
                </li>
                @endforeach
                <li class="dropdown nav-item" data-toggle="tooltip" data-placement="bottom" title="优秀博客友链">
                    <a class="nav-link"  style="color:red !important;"  href="{{url('friends')}}">
                        <i class="fa fa-fire" aria-hidden="true"></i> 优秀博主
                    </a>
                </li>
                <!--<li class="dropdown nav-item" data-toggle="tooltip" data-placement="bottom" title="新奇点">-->
                <!--    <a class="nav-link" href="http://smoney.seedblog.cn" target="_blank">-->
                <!--        新奇点-->
                <!--    </a>-->
                <!--</li>-->
                <!--<li class="dropdown nav-item" data-toggle="tooltip" data-placement="bottom" title="收藏的网站地址">-->
                <!--    <a class="nav-link" href="{{url('nav')}}" target="_blank">-->
                <!--       工具网址  -->
                <!--    </a>-->
                <!--</li>-->
                <li class="dropdown nav-item" data-toggle="tooltip" data-placement="bottom" title="时间线记录">
                    <a class="nav-link" href="{{url('line')}}">
                        归档在线
                    </a>
                </li>
                <li class="dropdown nav-item" data-toggle="tooltip" data-placement="bottom" title="福利专区">
                    <a class="nav-link" href="/shop/index"  target="_blank">
                         福利专区
                    </a>
                </li>
                <li class="dropdown nav-item">
                    <a class="nav-link" href="{{url('about')}}">
                        关于博客
                    </a>
                </li>
                @if (!session('uid'))
                <li class="dropdown nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fa fa-user"></i>登录</a></li>
                @else
                <li class="dropdown nav-item">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(!session('avatar'))
                        <img src="/img/avatar/avatar15.png" class="img-responsive img-circle" width="25px" height="25px">
                        @else
                        <img src="{{session('avatar')}}" class="img-responsive img-circle" width="25px" height="25px">
                        @endif
                        {{session('uname')}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/center">个人中心</a>
                        <a class="dropdown-item" id="logout" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">退出</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>