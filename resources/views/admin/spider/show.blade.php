<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>抓取微信文章</title>
        <link href="https://cdn.bootcss.com/weui/1.1.3/style/weui.min.css" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div>
        <form method="GET" action="{{ url('admin/spiders') }}" accept-charset="UTF-8">
            <div class="weui-cells__title">url:</div>
                <div class="weui-cells">
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="url" type="text" placeholder="请输入url"/>
                        </div>
                    </div>
                </div>
                <div class="weui-btn-area">
                    <button class="weui-btn weui-btn_primary" id="showTooltips">确定</button>
                </div> 
        </form>
        </div>
        <div class="position-ref full-height"> 
            <div class="content">  
                     {!! $data['content'] !!} 
            </div>
        </div>
    </body>
</html>
