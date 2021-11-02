@extends('home.main')

@section('title',$video_result->video_title)

@push('scripts')
 <!-- Dplay 视频播放插件-->
 <link rel="stylesheet" href="{{asset(__STATIC_HOME__)}}/assets/dplay/DPlayer.min.css"> 
 <script src="{{asset(__STATIC_HOME__)}}/assets/dplay/DPlayer.min.js"></script> 
 <style>
 .pull-left {
    float: left;
}
.pull-right {
    float: right;
}
 </style>
@endpush

@section('content')
   
    <div class="container pt-5">
        <div class="title"> 
            <nav>
                <ol class="breadcrumb"> 
                    <li  class="breadcrumb-item active"><a href="/">首页</a></li>
                    <li class="breadcrumb-item"><a href="/video/35">视频列表</a></li> 
                </ol> 
            </nav>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h3>{{$video_result->video_title}}</h3> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9 mb-2">
                <div id="dplayer"></div>
                
                <div class="row">
                       <div class="col-sm-12">
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <a  @if($previousPostID==0) href="" @else href="{{url('video_details',['vid'=>$previousPostID])}}"  @endif >
                                    <div class="pull-left">
                                        <button class="btn btn-sm btn-success btn-round" type="button">
                                            <i class="fa fa-angle-left"></i>
                                             @if($previousPostID!=0) 
                                                上一个视频 
                                              @else
                                                没有了
                                              @endif
                                        </button>
                                    </div>
                                </a>
                                <a  @if($nextPostID==0) href="" @else href="{{url('video_details',['vid'=>$nextPostID])}}" @endif >
                                    <div class="pull-right">
                                        <button class="btn btn-sm btn-success btn-round" type="button">
                                           @if($nextPostID!=0) 
                                                下一个视频 
                                            @else
                                                没有了
                                            @endif
                                            <i class="fa fa-angle-right"></i>
                                        </button>
                                    </div>
                                </a>
                          </div>
                       </div>  
                     </div>
                 </div> 
                <div class="col-12">
                      <div class="share-dialog-cont"> 
                            <div class="share-platform">
                                <div class="share-platform-l" style="width:auto;margin-top:14px">分享:</div>
                                <div class="share-platform-r">
                                    <div class="bdsharebuttonbox">
                                        <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                                        <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                                        <a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
                                        <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                                    </div> 
                                </div>
                            </div>
                        </div>  
                </div>  

                <div class="col-12">  
                  <div style="text-align:center">
                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-lg" style="border-radius: 30px;">关注赞赏</button>
                  </div>   
                </div> 
                
            </div>
            <div class="col-sm-3"> 
                <div class="card">
                   <div class="card-body"> 
                        <h5>{{$video_result->video_title}}</h5>
                        <div class="col-sm-12 m-2">
                            @php
                                $tags = explode(',',$video_result->video_tag);
                            @endphp
                            @foreach($tags as $k => $tag)
                                <label class="badge badge-pill badge-{{$badge_arr[$k]}}">{{$tag}}</label>
                            @endforeach
                        </div>
                        <blockquote class="blockquote text-left">
                            <p class="mb-0">{{$video_result->video_describe}}</p>
                            <footer class="blockquote-footer text-right">{{date_conversion($video_result->created_at)}}</footer>
                        </blockquote>
                   </div>
                </div>
                @if(count($xuanpin))
                    @foreach ($xuanpin as $key=>$ad) 
                    <div class="card">
                        <a href="{{$ad->click_url}}" title="{{$ad->item_description}}" alt="{{$ad->title}}" target="_blank">
                        <img class="card-img-top" src="{{$ad->pict_url}}" alt="{{$ad->item_description}}">
                        </a>
                        <div class="card-body">
                            <p class="card-text">
                                {{$ad->item_description}}
                            </p>
                        </div>
                    </div>
                    @endforeach 
                @endif      
                
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group mt-3">
                    <label for="exampleFormControlTextarea1">给我留言</label>
                    <textarea class="form-control textarea-limited" id="msg_content" placeholder="读书不觉已春深，一寸光阴一寸金。" rows="3" maxlength="150"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-3" style="margin-bottom: 5px;">
                        <div class="input-group">
                            <input type="text" name="msg_blog_name" class="form-control" placeholder="博客名称">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="nc-icon nc-paper" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3" style="margin-bottom: 5px;">
                        <div class="input-group">
                            <input type="text" name="msg_blog_link" class="form-control" placeholder="博客网址">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="nc-icon nc-planet" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3" style="margin-bottom: 5px;">
                        <div class="input-group">
                            <input type="text" name="msg_blog_contact" class="form-control" placeholder="微信/QQ/邮箱">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="nc-icon nc-chat-33" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3" style="margin-bottom: 5px;">
                        <div class="input-group">
                            <button class="btn btn-primary btn-round" id="submit_msg">
                                <i class="fa fa-heart"></i>提 交
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="media-area">
                    <h3 class="mt-0" id="msg_record">留言条数·{{$video_message->total()}}</h3>
                    <input type="hidden" name="msg_total" value="{{$video_message->total()}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9" id="msg_board">
                @foreach($video_message as $k => $v)
                    <div class="col-sm-12 ml-auto">
                        <div class="card" data-background="color" data-color="{{$bg_arr[$k]}}">
                            <div class="card-body">
                                <div class="author">
                                    <a href="{{$v->msg_blog_link}}" target="_blank">
                                        <img src="{{asset(__STATIC_HOME__)}}/assets/img/qqhead.png" alt="..." class="avatar img-raised">
                                        <span>{{$v->msg_blog_name}}</span>
                                    </a>
                                </div>
                                <span class="category-social pull-right">
                                            <i class="fa fa-quote-right"></i>
                                        </span>
                                <div class="clearfix"></div>
                                <p class="card-description">“{{$v->msg_content}}”</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-9">
                <div class="pagination-area mt-3">
                    {{$video_message->onEachSide(1)->links('vendor.pagination.default')}}
                </div>
            </div>
        </div>
    </div> 
    <input type="hidden" name="video_url" value="/aetherupload/display/{{$video_result->video_link}}">

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">好的内容，值得关注</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-avatar border-white" style="text-align: center;">
                       
                            <img src="http://www.seedblog.cn/uploads/teng_ad/qrcode_for_gh_7a8bc85b3f32_258.jpg" alt="微信公众号" style="width:200px;height:200px">
                         
                            <img src="http://www.seedblog.cn/uploads/teng_ad/dashang.png" alt="打赏一下" style="width:230px;height:200px">
                         
                   </div> 
                </div> 
            </div>
        </div>
    </div>
@endsection

@push('backend-register-js')

<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"分享到新浪微博","bdMini":"1","bdMiniList":["bdxc","tqf","douban","bdhome","sqq","thx","ibaidu","meilishuo","mogujie","diandian","huaban","duitang","hx","fx","youdao","sdo","qingbiji","people","xinhua","mail","isohu","yaolan","wealink","ty","iguba","fbook","twi","linkedin","h163","evernotecn","copy","print"],"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
 
<script> 
        $(function () {
            dplay(); 
        });

        $('#myModal').on('hidden.bs.modal', function (e) {
        // do something...
        })

        
        function dplay() {
            var video_url = $("input[name='video_url']").val();
            var pic = '/uploads/'+"{{$video_result->video_img}}";
            const dp = new DPlayer({
                container: document.getElementById('dplayer'),
                lang:'zh-cn',
                loop: true,
                autoplay:false,
                video: {
                    url: video_url,
                    pic: pic
                },
                screenshot:true

            });
            //绑定播放事件
            dp.on('play', function() {

            });
        }

        $("#submit_msg").click(function(){
            var msg_content = $("#msg_content").val();
            var msg_blog_name = $("input[name='msg_blog_name']").val();
            var msg_blog_link = $("input[name='msg_blog_link']").val();
            var msg_blog_contact = $("input[name='msg_blog_contact']").val();
            var foreign_id = "{{$video_result->id}}";
            var url = "{{url('article_msg')}}";
            $.ajax({
                url: url,
                dataType: "json",
                data: {msg_content: msg_content,msg_blog_name:msg_blog_name,msg_blog_link:msg_blog_link,msg_blog_contact:msg_blog_contact,foreign_id:foreign_id,msg_type:2},
                type: "post",
                beforeSend: function () {
                    var index = layer.load(1, {
                        shade: [0.1, '#fff'] //0.1透明度的白色背景
                    });
                },
                success: function (data) {
                    layer.closeAll();
                    layer.msg(data.msg);
                    var msg_div = data.result;
                    append_msg_content(msg_div);
                },
                error: function (data) {
                    layer.closeAll();
                    if(data.responseJSON.errors){
                        var get_name = ['msg_content','msg_blog_name','msg_blog_link','msg_blog_contact'];
                        var lenght = get_name.length;
                        var err_msg = data.responseJSON.errors;

                        // console.log(err_msg);return false;
                        for(var i = 0;i<lenght;i++){
                            var err_name = get_name[i];
                            if(err_msg[err_name]){
                                layer.msg(err_msg[err_name][0]);
                                break;
                            }
                        }
                    }else{
                        layer.msg('提交失败,请重试');
                    }
                }
            });
        });

        function append_msg_content(msg_div){
            var msg_board = $("#msg_board");
            msg_board.prepend(msg_div);
            //留言条数增加
            var msg_total = $("input[name='msg_total']").val();
            var total_number = parseInt(msg_total) + 1;
            $("input[name='msg_total']").val(total_number);
            var msg_record = "留言条数·"+total_number;
            $("#msg_record").html(msg_record);
        }
    </script>
@endpush