<div class="card ">
  <div class="card-body">
    <a href="{{ route('topics.create') }}" class="btn btn-success btn-block" aria-label="Left Align">
      <i class="fas fa-pencil-alt mr-2"></i> 新建帖子
    </a>
  </div>
</div>

@if (count($active_users))
  <div class="card mt-4">
    <div class="card-body active-users pt-2">
      <div class="text-center mt-1 mb-0 text-muted">活跃用户</div>
      <hr class="mt-2">
      @foreach ($active_users as $active_user)
        <a class="media mt-2" href="#">
          <div class="media-left media-middle mr-2 ml-1">
            @if(!$active_user->avatar)  
            <img src="/img/avatar/avatar15.png" width="24px" height="24px" class="media-object">
            @else
            <img src="{{ $active_user->avatar }}" width="24px" height="24px" class="media-object">
            @endif
          </div>
          <div class="media-body">
            <small class="media-heading text-secondary">{{ $active_user->username }}</small>
          </div>
        </a>
      @endforeach
    </div>
  </div>
@endif
 
  <div class="card mt-4">
    <div class="card-body pt-2">
      <div class="text-center mt-1 mb-0 text-muted">资源推荐</div>
      <hr class="mt-2 mb-3"> 
        <a class="media mt-1" href="/wiki">
          <div class="media-body">
            <span class="media-heading text-muted">wiki文章</span>
          </div>
        </a>
   
    </div>
  </div>
 
