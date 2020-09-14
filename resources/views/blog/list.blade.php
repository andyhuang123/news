@if (count($blogs))
  <ul class="list-unstyled">
    @foreach ($blogs as $topic)
      <li class="media">
        <div class="media-left">
          <a href="#">
            <img class="media-object img-thumbnail mr-3" style="width: 52px; height: 52px;" src="/uploads/images/f3be6e538141993c909527c47a563450.jpg" title="php漫游指南">
          </a>
        </div>

        <div class="media-body">

          <div class="media-heading mt-0 mb-1">
            <a href="{{url('show',['id'=>$topic->id])}}" title="{{ $topic->article_title }}" target="_blank">
              {{ $topic->article_title }}
            </a>
            <a class="float-right" href="{{url('article_details',['id'=>$topic->id])}}">
              <span class="badge badge-secondary badge-pill"> <i class="fa fa-eye"></i> {{ $topic->article_click }} </span>
            </a>
          </div>

          <small class="media-body meta text-secondary">

            <a class="text-secondary" href="{{url('article',['nav_id'=>$topic->nav_name->id])}}" title="{{ $topic->nav_name->nav_title }}" target="_blank">
              <i class="far fa-folder"></i>
               {{ $topic->nav_name->nav_title }}  
            </a>

            <span> • </span>
            <a class="text-secondary" href="#" title="#">
              <i class="far fa-user"></i>
              adminer
            </a>
            <span> • </span>
            <i class="far fa-clock"></i>
            <span class="timeago" title="最后活跃于：{{ $topic->created_at }}">{{ $topic->created_at->diffForHumans() }}</span>
          </small>

        </div>
      </li>

      @if ( ! $loop->last)
        <hr>
      @endif

    @endforeach
  </ul>

@else
  <div class="empty-block">暂无数据 ~_~ </div>
@endif