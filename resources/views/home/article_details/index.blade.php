@extends('home.main')
@section('title',$article_result->article_title)
@section('content')
<style>
    p {
        font-weight: 400;!important
    }
      .card img {
        max-width: 100%;
        height: auto;
        border-radius: 12px 12px 12px 12px;
    }
    .ui.green.label, .ui.green.labels .label {
        background-color: #21ba45!important;
        border-color: #21ba45!important;
        color: #fff!important;   
    }
    
    .ui.red.label, .ui.red.labels .label {
        background-color: #ff0000!important;
        border-color: #ff0000!important;
        color: #fff!important;   
    }
    
</style>
<link rel="stylesheet" type="text/css" href="{{asset(__STATIC_HOME__)}}/assets/share/share.css" />
<div class="container pt-5">
        <div class="title"> 
        </div>
        <!--右侧边栏开始-->
        <div class="row">
            <div class="col-sm-9" data-parallax="true">
               
                <div class="card">
                   <div class="card-body">
                        <main class="col-sm-12 bd-content pb-4">
                            <h4 class="bd-title">{{$article_result->article_title}}</h4>
                            <blockquote class="blockquote text-right"> 
                                <p class="mb-0">
                                    <i class="fa fa-eye"></i>{{$article_result->article_click}} 
                                    &nbsp;&nbsp; 
                                    <i class="fa fa-comments-o"></i>{{$article_message->total()}}
                                     &nbsp;&nbsp; 
                                    最后更新时间：{{$article_result->updated_at}}</p>
                            </blockquote>
                            <div class="col-sm-12 m-2">
                                @php
                                    $tags = explode(',',$article_result->article_tag);
                                @endphp
                                @foreach($tags as $k => $tag)
                                    <span class="badge badge-{{$badge_arr[$k]}} badge-pill">{{$tag}}</span>
                                @endforeach
                            </div> 
                            <div class="col-sm-12 p-0 normal" id="scroll">
                                <div id="test-editor" data-toc="#toc">
                                    <textarea style="display:none;">{{$article_result->article_content}}</textarea>
                                </div>
                            </div>
                        </main>
                   </div>
                 </div> 
                 
                 <div class="card">
                    <div class="card-body"> 
                        <div class="row">
                           <div class="col">
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
                           <div class="col">
                           <div class="col-sm-12">
                                <div class="text-center" style="margin-top: 14px;">
                                    <button type="button" class="btn btn-primary btn-round btn-sm" onclick="goodlike({{$article_result->id}})">
                                        <i class="fa fa-thumbs-o-up"></i>
                                        点赞<span id="goodlike"> 
                                                @if ( $article_result->goodlike > 100)
                                                    100+
                                                @else
                                                    {{$article_result->goodlike}}
                                                @endif
                                            </span>
                                    </button>
                                    
                                        <button type="button" class="btn btn-primary btn-round btn-sm" onclick="favorites({{$article_result->id}})">
                                        @if($is_favorit) 
                                            <i class="fa fa-heart heart"></i> 
                                        @else 
                                            <i class="fa fa-heart-o"></i>
                                        @endif
                                        收藏
                                    </button>
                                    
                                    <button type="button" class="btn btn-primary btn-round btn-sm" onclick="subemail({{$article_result->id}})">
                                        <i class="fa fa-eye"></i>
                                        订阅
                                    </button>
                                    <button type="button" class="btn btn-primary btn-round btn-sm" onclick="addBookmark('{{$article_url}}','buffer now')">
                                        <i class="fa fa-bookmark-o"></i>
                                        书签
                                    </button>
                                </div>
                            </div> 
                           </div>
                        </div>
                    </div>
                 </div>
            </div>
            
            <div class="col-sm-3" id="toc-container"> 
                  <div class="toc" id="toc"></div>     
            </div> 

         
        </div>
        <!--右侧边栏结束-->
        
        <div class="row">
            <div class="col-sm-9">
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <a href="{{url('article_details',['a_id'=>$previousPostID])}}">
                            <div class="pull-left">
                                <button class="btn btn-sm btn-success btn-round" type="button">
                                    <i class="fa fa-angle-left"></i>上一篇
                                </button>
                            </div>
                        </a>
                        <a href="{{url('article_details',['a_id'=>$nextPostID])}}">
                            <div class="pull-right">
                                <button class="btn btn-sm btn-success btn-round" type="button">
                                    下一篇<i class="fa fa-angle-right"></i>
                                </button>
                            </div>
                        </a>
                    </div>
                </div> 
               
            </div> 
            <div class="col-sm-9 mt-3">
                <div class="card">
                    <div class="card-header bg-transparent">
                           <p><h5><i class="fa fa-check" aria-hidden="true" style="color: #1cb71c;"></i>  推荐文章</h5></p>   
                    </div>
                   <div class="card-body">
                        <ul class="list-unstyled"> 
                         @foreach ($recommend_article as $topic)
                            <li class="media">
                                <div class="media-left">
                                  <a href="#">
                                    <img class="media-object img-thumbnail mr-3" style="width: 52px; height: 52px;" src="/uploads/images/f3be6e538141993c909527c47a563450.jpg" title="php漫游指南">
                                  </a>
                                </div> 
                                <div class="media-body"> 
                                  <div class="media-heading mt-0 mb-1">
                                    <a href="{{url('article_details',['id'=>$topic->id])}}" style="font-weight: 500;" title="{{ $topic->article_title }}">
                                       <span class="hide-on-mobile ui label status small green">博客</span> 
                                        {{ $topic->article_title }}
                                    </a> 
                                    <a class="float-right" href="{{url('article_details',['id'=>$topic->id])}}">
                                          <span class="badge badge-secondary badge-pill"> <i class="fa fa-thumbs-o-up"></i> 
                                             @if ( $topic->goodlike > 100)
                                                  100+
                                             @else
                                                 {{ $topic->goodlike  }} 
                                             @endif
                                          </span>
                                     </a> 
                                  </div> 
                                   <small class="media-body meta text-secondary">  
                                        <a class="text-secondary" href="{{url('article',['nav_id'=>$topic->nav_id])}}" title="{{ $topic->nav_name->nav_title }}">
                                            <i class="far fa-folder"></i> {{ $topic->nav_name->nav_title }}  
                                        </a> 
                                        <span> • </span>
                                        <a class="text-secondary" href="{{url('article_details',['id'=>$topic->id])}}" title="{{ $topic->article_title }}">
                                           <i class="far fa-user"></i>adminer
                                        </a>
                                        <span> • </span>
                                        <i class="far fa-clock"></i>
                                        <span class="timeago" title="最后活跃于： {{ $topic->created_at }}"> {{ $topic->created_at->diffForHumans() }} </span>
                                   </small>
                                  
                                </div>
                              </li>
                              @if ( ! $loop->last)
                                        <hr>
                              @endif
                             @endforeach      
                        </ul>
                       
                   </div>
                 </div>
            </div> 
            <div class="col-sm-9 mt-3">
                <div class="card">
                    <div class="card-header bg-transparent">
                           <p><h5><i class="fa fa-cart-plus" aria-hidden="true" style="color: #1cb71c;"></i> 热销物品</h5></p>   
                    </div>
                   <div class="card-body">
                       <div class="row">
                          @foreach ($ads as $ad)
                            <div class="col">
                                <div class="card">
                                    <a href="{{$ad->click_url}}"  target="_blank">
                                    <img class="card-img-top" src="{{$ad->pict_url}}" alt="Card image" style="width:100%">
                                    </a>
                                    <div class="card-body">
                                    <h6 class="card-title">{{$ad->title}}</h6>
                                    <p class="card-text" style="padding-top:5px">
                                      @if(isset($ad->coupon_click_url))
                                      <a href="{{$ad->coupon_click_url }}"  target="_blank">
                                       <span class="label label-danger" style="line-height: 20px;border-radius: 5px;">领取{{$ad->coupon_amount}}元优惠券</span>
                                       </a>
                                      @endif
                                    </p>
                                    <a href="{{$ad->click_url}}" class="btn btn-primary" target="_blank">查看详情</a>
                                    </div>
                                </div>
                            </div>
                           @endforeach  
                          </div>
                        </div>
                   </div>
                 </div>
            </div> 
            <div class="col-sm-9 mt-3">
                <div class="bd-example" data-example-id="">
                    <div class="card">
                        <div class="card-body">
                            <blockquote class="blockquote blockquote-primary mb-0">
                                <p>您必须遵守 署名-非商业性使用-相同方式共享 <a href="https://creativecommons.org/licenses/by-nc-sa/4.0" class="btn btn-link btn-success p-0" target="_blank">CC BY-NC-SA</a> 使用这篇文章</p>
                                <p>本文链接：<a href="{{$article_url}}" class="text-info" target="_blank">{{$article_url}}</a></p>
                                <footer class="blockquote-footer">转载注明出处：{{$configs['base.website_title']}}</footer>
                            </blockquote>
                            <blockquote class="blockquote blockquote-primary mb-0">
                                  <div class="row">
                                    <div  class="col-sm-12">扫码关注公众号</div>
                                    <div  style="text-align:center;margin:auto">
                                        <img style="height: 150px;width: 150px;margin: 0 auto"  src="http://www.seedblog.cn/uploads/teng_ad/qrcode_for_gh_7a8bc85b3f32_258.jpg" >  
                                    </div>     
                                 </div>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        
        <div class="row">
            <div class="col-sm-9">
            <div class="form-group mt-3">
                    <label for="exampleFormControlTextarea1">给我留言·{{$article_message->total()}}</label>
                    <textarea class="form-control textarea-limited" id="msg_content" placeholder="读书不觉已春深，一寸光阴一寸金。" rows="3" maxlength="150"></textarea>
            </div> 
            </div>
            <div class="col-sm-9">
                <div class="row"> 
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
            <div class="col-sm-9">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="media-area">
                                <h3 class="mt-0" id="msg_record">留言条数·{{$article_message->total()}}</h3>
                                <input type="hidden" name="msg_total" value="{{$article_message->total()}}">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="msg_board">
                        @foreach($article_message as $k => $v)
                            <div class="col-sm-12 ml-auto">
                                <div class="card" data-background="color" data-color="{{$bg_arr[$k]}}">
                                    <div class="card-body">
                                        <div class="author">
                                            <a href="{{$v->msg_blog_link}}" target="_blank">
                                                <img src="{{asset(__STATIC_HOME__)}}/assets/img/qqhead.png" alt="..." class="avatar img-raised">
                                                <span>{{$v->owner->username}}</span>
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
                </div>
                <div class="col-sm-12">
                    <div class="pagination-area mt-3">
                        {{$article_message->onEachSide(1)->links('vendor.pagination.default')}}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"分享到新浪微博","bdMini":"1","bdMiniList":["bdxc","tqf","douban","bdhome","sqq","thx","ibaidu","meilishuo","mogujie","diandian","huaban","duitang","hx","fx","youdao","sdo","qingbiji","people","xinhua","mail","isohu","yaolan","wealink","ty","iguba","fbook","twi","linkedin","h163","evernotecn","copy","print"],"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
  <!--  <script src="{{asset(__STATIC_HOME__)}}/assets/share/ZeroClipboard.js"></script>-->
 	<!--<script>-->
		<!--var g_url = window.location.href;-->
	 <!--   $('.share-copy-c input').val(g_url);-->
		<!--var clip = new ZeroClipboard( document.getElementById("btnCopy"));-->
  <!--	</script>--> 
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
        $(function () {
            markdown(); 
        });
        
        function markdown() {
            var testEditor;
            $(function() {
                testEditor = editormd.markdownToHTML("test-editor", { //注意：这里是上面DIV的id
                    htmlDecode: "style,script,iframe",
                    emoji: true,
                    taskList: true,
                    tocm: true,
                    markdownSourceCode: false, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
                    flowChart: true, // 默认不解析
                    sequenceDiagram: true, // 默认不解析
                    codeFold: true
                });
            });
            
            $(document).ready(function() { 
                if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
                    const scroll = document.querySelector('#scroll')
                    const tocHelper = new TocHelper({
                        dom: 'div[data-toc]',
                        offsetBody: document.querySelector('#scroll'),
                        tocFixed:false,
                        showBefore: function () { 
                            scroll.classList.remove('col-sm-12')
                        },
                        hiddenAfter: function () {
                            scroll.classList.add('col-sm-12')
                        }
                    })
                    tocHelper.reset()
                   
                   
                }else{
                    const scroll = document.querySelector('#scroll')
                    const tocHelper = new TocHelper({
                        dom: 'div[data-toc]',
                        offsetBody: document.querySelector('#scroll'),
                        tocFixed: {
                            top: 100,
                        },
                        showBefore: function () { 
                            scroll.classList.remove('col-sm-12')
                        },
                        hiddenAfter: function () {
                            scroll.classList.add('col-sm-12')
                        }
                    })
                    tocHelper.reset()
                }
                
                const switchBtn = function () {
                    scroll.classList.contains('normal') ? (scroll.classList.remove('normal'), scroll.classList.add('scroll')) : (scroll.classList.add('normal'), scroll.classList.remove('scroll'))
                    tocHelper.megre({ offsetBody: document.querySelector('#scroll') }).reload()
                }
        
                const togger = function () {
                    tocHelper.togger()
                } 
                
            });
        }
        
        $("#submit_msg").click(function(){
            var msg_content = $("#msg_content").val();
            var msg_blog_name = $("input[name='msg_blog_name']").val();
            var msg_blog_link = $("input[name='msg_blog_link']").val();
            var msg_blog_contact = $("input[name='msg_blog_contact']").val();
            var foreign_id = "{{$article_result->id}}";
            var url = "{{url('article_msg')}}";
            $.ajax({
                url: url,
                dataType: "json",
                data: {msg_content: msg_content,msg_blog_name:msg_blog_name,msg_blog_link:msg_blog_link,msg_blog_contact:msg_blog_contact,foreign_id:foreign_id,msg_type:1},
                type: "post",
                beforeSend: function () {
                    var index = layer.load(1, {
                        shade: [0.1, '#fff'] //0.1透明度的白色背景
                    });
                },
                success: function (data) {
                    layer.closeAll(); 
                    if(data.status==0){
                          layer.msg(data.msg);
                    }else if(data.status==-1)
                    {
                         layer.msg(data.msg);
                         location.href = "{{ asset('login') }}";
                        
                    }
                    else{
                         var msg_div = data.result;
                         append_msg_content(msg_div);
                    }
                   
                },
                error: function (data) {
                    layer.closeAll();
                    if(data.responseJSON.errors){
                        var get_name = ['msg_content'];
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

        function subemail(id){
            var url = "{{url('article_sub')}}";
            $.ajax({
                url: url,
                dataType: "json",
                data: {id: id },
                type: "post", 
                success: function (data) {
                    layer.closeAll(); 
                    if(data.status){
                         layer.msg(data.msg);
                          
                    }else if(data.status < 0){
                         layer.msg(data.msg);
                          self.location.href='/login';
                    
                    }else{
                        layer.msg(data.msg);
                    }
                   
                },
                error: function (data) {
                    layer.closeAll();
                    
                }
            });
        }
        function favorites(id){
            var url = "{{url('article_favorite')}}";
            $.ajax({
                url: url,
                dataType: "json",
                data: {id: id },
                type: "post", 
                success: function (data) {
                    layer.closeAll(); 
                    if(data.status){
                         layer.msg(data.msg);
                          
                    }else if(data.status < 0){
                         layer.msg(data.msg);
                         self.location.href='/login';
                    
                    }else{
                        layer.msg(data.msg);
                    }
                   
                },
                error: function (data) {
                    layer.closeAll();
                    
                }
            });
        }
        function goodlike(id){ 
            var url = "{{url('article_like')}}";
            $.ajax({
                url: url,
                dataType: "json",
                data: {id: id },
                type: "post", 
                success: function (data) {
                    layer.closeAll(); 
                    if(data.status){
                         layer.msg(data.msg);
                         $('#goodlike').html(data.goodlike);
                    }else{
                         layer.msg(data.msg);
                    
                    }
                   
                },
                error: function (data) {
                    layer.closeAll();
                    
                }
            });
            
        }
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

        function addBookmark(url, title) {
            if (!url) {
                url = window.location
            }
            if (!title) {
                title = document.title
            }
            var browser = navigator.userAgent.toLowerCase();
            if (window.sidebar) { // Mozilla, Firefox, Netscape
                window.sidebar.addPanel(title, url, "");
            } else if (window.external) { // IE or chrome
                if (browser.indexOf('chrome') == -1) { // ie
                    window.external.AddFavorite(url, title);
                } else { // chrome
                    layer.msg('请按ctrl+d（或macs的command+d）将此页加入书签。');
                }
            } else if (window.opera && window.print) { // Opera - automatically adds to sidebar if rel=sidebar in the tag
                return true;
            } else if (browser.indexOf('konqueror') != -1) { // Konqueror
                layer.msg('请按ctrl+b将此页加入书签。');
            } else if (browser.indexOf('webkit') != -1) { // safari
                layer.msg('请按ctrl+b（或macs的command+d）将此页加入书签。');
            } else {
                layer.msg('您的浏览器无法使用此链接添加书签。请手动添加此链接。')
            }
        }
    </script>
     
    <script type="text/javascript">
        var ua = navigator.userAgent.toLowerCase();
        var copy_url = "{{$article_url}}";
        var author = "{{$configs['user_info.full_name']}}";
        var site_name = "{{$configs['base.website_title']}}";
        if (window.ActiveXObject) {  /* 兼容IE */
            document.body.oncopy = function () {
                event.returnValue = false;
                var selectedText = document.selection.createRange().text;
                var pageInfo = '<br>---------------------<br>著作权归作者所有。<br>'
                    + '非商业转载请注明出处。<br>'
                    + '作者：'+ author +'<br> 源地址：' + copy_url
                    + '<br>来源：'+site_name+'<br>© 本文为' + site_name + '「'+ author + '」的原创文章，遵循 CC BY-NC-SA 版权协议，转载请附上原文出处链接及本声明。';
                clipboardData.setData('Text', selectedText.replace(/\n/g, '<br>') + pageInfo);
            }
        }
        else {
            function addCopyRight() {
                var body_element = document.getElementsByTagName('body')[0];
                var selection = window.getSelection();
                var pageInfo = '<br>---------------------<br>著作权归作者所有。<br>'
                    + '非商业转载请注明出处。<br>'
                    + '作者：'+ author +'<br> 源地址：' + copy_url
                    + '<br>来源：'+site_name+'<br>© 本文为' + site_name + '「'+ author + '」的原创文章，遵循 CC BY-NC-SA 版权协议，转载请附上原文出处链接及本声明。';
                var copyText = selection.toString().replace(/\n/g, '<br>') + pageInfo;  // Solve the line breaks conversion issue
                var newDiv = document.createElement('div');
                newDiv.style.position = 'absolute';
                newDiv.style.left = '-99999px';
                body_element.appendChild(newDiv);
                newDiv.innerHTML = copyText;
                selection.selectAllChildren(newDiv);
                window.setTimeout(function () {
                    body_element.removeChild(newDiv);
                }, 0);
            }
            document.oncopy = addCopyRight;
        }
    </script>
@endsection
