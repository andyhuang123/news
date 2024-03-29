<style>
    .foot-wrap {
        background-color: #ffffff;
        margin-top: 80px;
    }

    .row-content {
        >h3 {
            color: #DDD;
            font-size: 16px;
            font-weight: 300;
            line-height: 16px;
            margin: 40px 0 30px 34px;
        }

        >ul {
            font-size: 13px;
            line-height: 24px;

            >li {
                list-style: none;

                >a {
                    color: #878B91;

                    &:hover {
                        text-decoration: none;
                        color: #c1ba62;
                    }
                }
            }
        }
    }

    ul.social {
        margin: 0;
        padding: 0;
        width: 100%;
        text-align: center;

        >li {
            display: inline-block;

            >a {
                display: inline-block;
                font-size: 18px;
                line-height: 30px;
                .square(30px);
                border-radius: 36px;
                background-color: @gray-light;
                color: #fff;
                margin: 0 3px 3px 0;

                &:hover {
                    text-decoration: none;
                    background-color: @link-hover-color;
                }
            }
        }
    }
</style>
<footer class="container-fluid foot-wrap">
    <!--采用container，使得页尾内容居中 -->
    <div class="container">
        <div class="row">
            <div class="row-content col-lg-3 col-sm-3 col-xs-6">
                <h3>wiki文章</h3>
                <ul>
                    <li><a href="/wiki">wiki文章</a></li>

                </ul>
            </div>

            <div class="row-content col-lg-3 col-sm-3 col-xs-6">
                <h3>留言列表</h3>
                <ul>
                    <li><a href="/message">快来留言</a></li>

                </ul>

            </div>
            <div class="row-content col-lg-3 col-sm-3 col-xs-6">
                <h3>优秀推荐</h3>
                <ul>
                    <li><a href="/friends">优秀博主</a></li>

                </ul>
            </div>
            <div class="row-content col-lg-3 col-sm-3 col-xs-6">
                <h3>关于博客</h3>
                <ul>
                    <li><a href="/about">关于博客</a></li>

                </ul>
            </div>

        </div>
    </div>

    <!-- 社交图标列表，其中图标采用的是Font Awesome图标字体库-->
    <ul class="social">

        <li style="list-style:none;">
            <a href="https://github.com/andyhuang123" title="Github Profile">
                <i class="icon fa fa-github" style="font-size: 24px;"></i>
            </a>
        </li>
        <li style="list-style:none;">
            <i class="fa fa-heart heart"></i>已运行:<span id="runtime">0</span>
        </li>

    </ul>
    <p align="center" style="margin-top: 20px;margin-bottom: 0px;">
        <a href="https://beian.miit.gov.cn/" class="text-secondary" target="_blank" style="color:#171616;">{{$configs['base.website_keep']}}</a>
        Copyright &copy;
        <span class="copyright">
            <script>
                document.write(new Date().getFullYear())
            </script>，{{$configs['base.motto']}}
        </span>
    </p>

</footer>
<script type="text/javascript">
    function runTime() { //运行倒计时
        var longTime;
        var oldTime = new Date('2019/10/01 00:00:00');
        var timer = setInterval(function() {
            var nowTime = new Date();
            var longTime = nowTime - oldTime;
            var days = parseInt(longTime / 1000 / 60 / 60 / 24, 10); //计算剩余的天数
            var hours = parseInt(longTime / 1000 / 60 / 60 % 24, 10); //计算剩余的小时
            var minutes = parseInt(longTime / 1000 / 60 % 60, 10); //计算剩余的分钟
            var seconds = parseInt(longTime / 1000 % 60, 10); //计算剩余的秒数
            longTime = days + "天" + hours + "小时" + minutes + "分" + seconds + "秒";
            $('#runtime').html(longTime)
        }, 1000)
    }
    runTime();
</script>