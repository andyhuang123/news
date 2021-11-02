<div class="row">
            <div class="col-sm-9">
                <div class="form-group mt-3">
                        <label for="exampleFormControlTextarea1">给我留言·{{$article_message->total()}}</label>
                        <textarea class="form-control textarea-limited" id="msg_content" placeholder="请写下你的问题" rows="3" maxlength="150"></textarea>
                </div> 
            </div>
            <div class="col-sm-9">
                <div class="row"> 
                    <div class="col-sm-3" style="margin-bottom: 5px;">
                        <div class="input-group">
                            <button class="btn btn-primary btn-sm" id="submit_msg">
                              <i class="fa fa-share mr-1"></i> 回复
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
