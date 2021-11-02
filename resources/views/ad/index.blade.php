 @if(!empty($topic))
<li class="media">
    <div class="media-left">
        <a href="{{$topic->tag_url}}" title="{{ $topic->article_title }}"> 
            <img class="media-object img-thumbnail mr-3" style="width: 52px; height: 52px;" src="{{$topic->ad_img}}" title="{{ $topic->article_title }}">
        </a>
    </div>
    <div class="media-body">
        <div class="media-heading mt-0 mb-1">
            <a href="{{$topic->tag_url}}" style="font-weight: 500;font-size: 1.2em;" title="{{ $topic->article_title }}" target="_blank">
                <span class="hide-on-mobile ui label status small red">广告</span>
                 {{ $topic->article_title }}
            </a>
            <a class="float-right" href="{{$topic->tag_url}}" target="_blank">
                <span class="badge badge-secondary badge-pill">
                    <i class="fa fa-newspaper-o"></i>查看详情</span>
            </a>
        </div>
        <small class="media-body meta text-secondary">
            <a class="text-secondary" href="/shop/index" title="ad">
                <i class="far fa-folder"></i> 广告
            </a>
            <span> • </span>
            <a class="text-secondary" href="/shop/index" title="ad">
                <i class="far fa-user"></i>adminer
            </a>
            <span> • </span> 
            <i class="far fa-clock"></i>
            <span class="timeago" title="最后活跃于：{{ $topic->created_at }}">{{ $topic->created_at->diffForHumans() }}</span>
        </small>

    </div>
</li>
<hr>
 @endif