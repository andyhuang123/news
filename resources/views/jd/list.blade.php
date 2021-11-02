
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>京东官方活动推广</title> 
    <link rel="stylesheet" href="/css/index.css">
</head>

<body>
    <div class="header">京东官方活动列表</div>
    <div id="app">
        <div class="container" :class="productList.length ? 'show': ''">
            <div class="section"  v-for="(product, index) in productList" v-if="product.actStatus===2"  @click="handleClick('Activity,' + product.urlPC+',')" >
                <div class="product-img" v-if="product.imgList">
                    <img :src="product.imgList[3].imgUrl" alt="" />
                </div>
                <div class="product-name"> 
                    <span class="product-name-text" v-text="product.title"></span>
                </div>
                <div class="product-info flex-row">
                    <!-- <div class="product-price">￥<span class="em" v-text="String(product.price).split('.')[0]"> </span>.<span v-text="String(product.price).split('.')[1]||'0'"></span>/天</div> -->
                    <div class="product-rent-start"><span class="text"><span  v-text="product.advantage"></span></span></div>
                </div>
            </div>
           
        </div>
        <div class="footer" v-if="isMaxPage">- 不要扯了 已经扯到底了 -</div>
        <div class="footer" v-if="!isMaxPage">- loading -</div>
    </div>
    <script src="https://cdn.bootcss.com/vue/2.5.16/vue.min.js"></script>
    <script src="https://cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>
    <script>
        if (navigator.userAgent.indexOf('AlipayClient') > -1) {
            document.writeln(
                '<script src="https://appx/web-view.min.js"' +
                '>' +
                '<' +
                '/' +
                'script>'
            );
        } else if (navigator.userAgent.indexOf('MicroMessenger') > -1) {
            document.writeln(
                '<script src="https://res.wx.qq.com/open/js/jweixin-1.3.2.js"' +
                '>' +
                '<' +
                '/' +
                'script>'
            );
        }

        !(function (e, t, n, g, i) {
            (e[i] =
                e[i] ||
                function () {
                    (e[i].q = e[i].q || []).push(arguments);
                }),
            (n = t.createElement('script')),
            (tag = t.getElementsByTagName('script')[0]),
            (n.async = 1),
            (n.src =
                ('https:' == document.location.protocol ? 'https://' : 'https://') +
                g),
            tag.parentNode.insertBefore(n, tag);
        })(window, document, 'script', 'assets.growingio.com/2.1/gio.js', 'gio');
        gio('init', 'a94e99cb7799a596', {});
        gio('send');
    </script>
    <script src="/js/index.js"></script>
</body>

</html>