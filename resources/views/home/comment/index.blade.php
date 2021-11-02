  <div class="row">
            <div class="col-sm-9">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="media-area"> 
                                <input type="hidden" name="msg_total" value="{{$article_message->total()}}">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="msg_board">  
                      <ul class="list-unstyled" style="width:100%;">
                            @foreach($article_message as $k => $v)
                            <div class="card">
                                <div class="card-body"> 
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="{{$v->msg_blog_link}}">
                                                <img class="media-object img-thumbnail mr-3" alt="" src="{{asset(__STATIC_HOME__)}}/assets/img/qqhead.png" style="width:48px;height:48px;" />
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="media-heading mt-0 mb-1 text-secondary">
                                                <a href="{{$v->msg_blog_link}}" title="{{$v->owner->username}}">
                                                    {{$v->owner->username}}
                                                </a>
                                                <span class="text-secondary"> • </span>
                                                <span class="meta text-secondary" title=" ">
                                                    {{ $v->created_at->diffForHumans() }}
                                                </span> 
                                                @if(Auth::check())
                                                    <span class="ml-1 bg-gray-100 px-3 transition ease-in-out duration-150 hover:bg-indigo-500 hover:text-white leading-6 rounded-md text-gray-500 whitespace-no-wrap inline-flex text-sm items-center"
                                                        @click=" ">
                                                    回复
                                                </span>
                                                @endif
                                            </div>
                                            <div class="reply-content text-secondary"> 
                                                {{$v->msg_content}}
                                            </div>
                                        </div>  
                                    </li>
                               </div>
                            </div> 
                            @endforeach 
                        </ul>
                        
                </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="pagination-area mt-3">
                        {{$article_message->onEachSide(1)->links('vendor.pagination.default')}}
                    </div>
                </div>
            </div>
        </div>    