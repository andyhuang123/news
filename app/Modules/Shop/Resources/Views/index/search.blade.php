<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>编码会馆-搜索</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="福利,热销商品,优惠券,快消,家电美居,服饰,9块9包邮,淘宝,掏宝,网上购物,C2C,在线交易,交易市场,网上交易,交易市场,网上买,网上卖,购物网站,团购,网上贸易,安全购物,电子商务,放心买,供应,买卖信息,网店,一口价,拍卖,网上开店,网络购物,打折,免费开店,网购,频道,店铺">
    <meta name="description" content="提供各类服饰、美容、家居、数码、话费/点卡充值… 数亿优质商品，同时提供担保交易(先收货后付款)等安全交易保障服务，并由商家提供退货承诺、破损补寄等消费者保障服务，让你安心享受网上购物乐趣！">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(__STATIC_SHOP__)}}/images/bag.png" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootstrapmb.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset(__STATIC_SHOP__)}}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset(__STATIC_SHOP__)}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset(__STATIC_SHOP__)}}/css/animate.min.css">
    <link rel="stylesheet" href="{{asset(__STATIC_SHOP__)}}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{asset(__STATIC_SHOP__)}}/css/slick.css">
    <link rel="stylesheet" href="{{asset(__STATIC_SHOP__)}}/css/chosen.min.css">
    <link rel="stylesheet" href="{{asset(__STATIC_SHOP__)}}/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="{{asset(__STATIC_SHOP__)}}/css/magnific-popup.min.css">
    <link rel="stylesheet" href="{{asset(__STATIC_SHOP__)}}/css/lightbox.min.css">
    <link rel="stylesheet" href="{{asset(__STATIC_SHOP__)}}/fancybox/source/jquery.fancybox.css">
    <link rel="stylesheet" href="{{asset(__STATIC_SHOP__)}}/css/jquery.scrollbar.min.css">
    <link rel="stylesheet" href="{{asset(__STATIC_SHOP__)}}/css/mobile-menu.css">
    <link rel="stylesheet" href="{{asset(__STATIC_SHOP__)}}/css/style.css">
</head>

<body class="productsgrid-page">
    <header class="header style7">

        <div class="container">
            <div class="main-header">
                <div class="row">
                    <div class="col-lg-3 col-sm-4 col-md-3 col-xs-7 col-ts-12 header-element">
                        <div class="logo" style="font-size: 24px;font-weight: 600;">
                            <a href="/">
                                <img src="{{asset(__STATIC_SHOP__)}}/images/logo.svg" alt="img" width="50px" height="50px">
                                <span style="font-size: 1.8rem;">编码福利</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-8 col-md-6 col-xs-5 col-ts-12">
                        <div class="block-search-block">
                            <form class="form-search form-search-width-category" method="get" action="/shop/search">
                                <div class="form-content">
                                    <div class="category"> 
                                    </div>
                                    <div class="inner">
                                        <input type="text" class="input" name="s" value="{{$key}}" placeholder="请输入关键词">
                                    </div>
                                    <button class="btn-search" type="submit">
                                        <span class="icon-search"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-12 col-md-3 col-xs-12 col-ts-12">
                        <div class="header-control">
                            <div class="block-minicart vereesa-mini-cart block-header vereesa-dropdown">
                            </div>
                            <div class="block-account block-header vereesa-dropdown">
                                <a href="javascript:void(0);" data-vereesa="vereesa-dropdown">
                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                </a>
                                <!-- <div class="header-account vereesa-submenu">
                                    <div class="header-user-form-tabs">
                                        <ul class="tab-link">
                                            <li class="active"><a data-toggle="tab" aria-expanded="true" href="#header-tab-login">Login</a></li>
                                            <li><a data-toggle="tab" aria-expanded="true" href="#header-tab-rigister">Register</a></li>
                                        </ul>
                                        <div class="tab-container">
                                            <div id="header-tab-login" class="tab-panel active">
                                                <form method="post" class="login form-login">
                                                    <p class="form-row form-row-wide"><input type="email" placeholder="Email" class="input-text"></p>
                                                    <p class="form-row form-row-wide"><input type="password" class="input-text" placeholder="Password"></p>
                                                    <p class="form-row"><label class="form-checkbox"><input type="checkbox" class="input-checkbox"><span>Remember me</span></label><input type="submit" class="button" value="Login"></p>
                                                    <p class="lost_password"><a href="#">Lost your password?</a></p>
                                                </form>
                                            </div>
                                            <div id="header-tab-rigister" class="tab-panel">
                                                <form method="post" class="register form-register">
                                                    <p class="form-row form-row-wide"><input type="email" placeholder="Email" class="input-text"></p>
                                                    <p class="form-row form-row-wide"><input type="password" class="input-text" placeholder="Password"></p>
                                                    <p class="form-row"><input type="submit" class="button" value="Register"></p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <a class="menu-bar mobile-navigation menu-toggle" href="#">
                            <span></span><span></span><span></span></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-nav-container">
            <div class="container">
                <div class="header-nav-wapper main-menu-wapper">
                    <div class="vertical-wapper block-nav-categori">
                        <div class="block-title"><span class="icon-bar"><span></span><span></span><span></span></span><span class="text">全部分类</span></div>
                       
                    </div>
                    <div class="header-nav">
                        <div class="container-wapper">
                            <ul class="vereesa-clone-mobile-menu vereesa-nav main-menu " id="menu-main-menu">
                                <li class="menu-item"><a href="/shop/index" class="vereesa-menu-item-title" title="Shop">热销</a></li>
                                <li class="menu-item"><a href="/shop/jiukuai" class="vereesa-menu-item-title" title="About">9块9</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="header-device-mobile">
        <div class="wapper">
            <div class="item mobile-logo">
                <div class="logo">
                    <a href="#">
                    <img src="{{asset(__STATIC_SHOP__)}}/images/logo.svg" alt="img" width="50px" height="50px">
                    <span style="font-size: 1.8rem;">编码福利</span>
                    </a>
                </div>
            </div>
            <div class="item item mobile-search-box has-sub">
                <a href="#"><span class="icon"><i class="fa fa-search" aria-hidden="true"></i></span></a>
                <div class="block-sub" style="z-index: 9999;">
                    <a href="#" class="close"><i class="fa fa-times" aria-hidden="true"></i></a>
                    <div class="header-searchform-box">
                        <form class="header-searchform" method="get" action="/shop/search">
                            <div class="searchform-wrap">
                            <input type="text" name="s" value="" class="search-input" placeholder="Enter keywords to search...">
                                <input type="submit" class="submit button" value="搜索">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="item menu-bar"><a class=" mobile-navigation  menu-toggle" href="#"><span></span><span></span><span></span></a></div>
        </div>
    </div>
    <div class="main-content main-content-product no-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-trail breadcrumbs">
                        <ul class="trail-items breadcrumb">
                            <li class="trail-item trail-begin"><a href="/shop/index">首页</a></li>
                            <li class="trail-item trail-end active">搜索</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="content-area shop-grid-content full-width col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="site-main">
                        <div class="shop-top-control">
                            <form class="select-item select-form" id="fitter">
                                <span class="title">搜索结果：{{ $total }}个商品</span>
                                 
                            </form>
                            <form class="filter-choice select-form">
                           
                            </form>
                            <div class="grid-view-mode">
                                <div class="inner">
                                    <a href="#" class="modes-mode mode-list">
                                        <span></span><span></span>
                                    </a>
                                    <a href="#" class="modes-mode mode-grid  active">
                                        <span></span><span></span><span></span><span></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <ul class="row list-products auto-clear equal-container product-grid">
                        @if(count($list))
                            @foreach($list as $ad)
                            <li class="product-item product-type-variable col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                                <div class="product-inner equal-element">
                                    <div class="product-top">
                                         @if(isset($ad->coupon_click_url))
                                         <div class="flash"> 
                                            <span class="onnew">  
                                                  <span class="text">  
                                                     <a href="{{$ad->coupon_click_url}}" target="_blank"> 
                                                      领取优惠券
                                                      </a> 
                                                    </span>  
                                            </span> 
                                        </div>
                                        @endif   
                                        <div class="yith-wcwl-add-to-wishlist">
                                            <div class="yith-wcwl-add-button">
                                                @if(isset($ad->coupon_click_url))
                                                    <a href="{{$ad->coupon_click_url}}" target="_blank">优惠券</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-thumb">
                                        <div class="thumb-inner">
                                            <a href="{{$ad->url}}" target="_blank"><img src="{{$ad->pict_url}}" alt="{{$ad->title}}"></a>
                                        </div>
                                        <a href="{{$ad->url}}" class="button quick-wiew-button"  target="_blank">Quick View</a>
                                    </div>
                                    <div class="product-info">
                                        <h5 class="product-name product_title">
                                            <a href="{{$ad->url}}" target="_blank"> {{$ad->title}}</a>
                                        </h5>
                                        <div class="group-info">
                                            <div class="stars-rating">
                                                <div class="star-rating"><span class="star-{{$ad->commission_rate}}"></span></div>
                                                <div class="count-star"> ({{$ad->commission_rate}})</div>
                                            </div>
                                            <div class="price"><del>¥{{$ad->reserve_price}}</del><ins>¥{{$ad->zk_final_price}}</ins></div>
                                        </div>
                                    </div>
                                    <div class="loop-form-add-to-cart">
                                        <div class="cart">
                                            <div class="single_variation_wrap">
                                               <a href="{{$ad->url}}" target="_blank">
                                                    <button class="single_add_to_cart_button button">立即购买</button>
                                                </a>
                                            </div> 
                                    </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        @else
                            <div class="empty-block">暂无数据 ~_~ </div>
                        @endif  
                       </ul>
                        <div class="pagination clearfix style2">
                            {{$list->onEachSide(1)->appends(['s'=>$key,'page'=>Request::except('page')])->links('vendor.pagination.default')}} 
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> 
    <a href="#" class="backtotop"><i class="pe-7s-angle-up"></i></a> 
    <script src="{{asset(__STATIC_SHOP__)}}/js/jquery-1.12.4.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/jquery.plugin-countdown.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/jquery-countdown.min.js"></script>
    <script src="http://cdn.bootstrapmb.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/owl.carousel.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/magnific-popup.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/isotope.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/jquery.scrollbar.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/jquery-ui.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/mobile-menu.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/chosen.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/slick.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/jquery.elevateZoom.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/jquery.actual.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/fancybox/source/jquery.fancybox.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/lightbox.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/owl.thumbs.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/jquery.scrollbar.min.js"></script>
    <script src="{{asset(__STATIC_SHOP__)}}/js/frontend-plugin.js"></script>
    <script> 
        $(() => {
            $('#fitter select').change(() => {  
                var p1 = $('#fitter select').val();
                window.location.href="/{{$url}}?materialId="+p1;//页面跳转并传参  
            }); 

        });

    </script>
    <script>
        var _hmt = _hmt || [];
        (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?e39c53125b433e702b474c1090fdf019";
        var s = document.getElementsByTagName("script")[0]; 
        s.parentNode.insertBefore(hm, s);
        })();
    </script>

     
</body>

</html>