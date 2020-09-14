<?php

namespace App\Observers;

use App\Models\Topic;
use App\Jobs\TranslateSlug;
use App\Notifications\CreateTopic;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function saving(Topic $topic)
    {
        // XSS 过滤
        $topic->body = clean($topic->body, 'user_topic_body');

        // 生成话题摘录
        $topic->excerpt = make_excerpt($topic->body);
    }

    public function saved(Topic $topic)
    {
        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if (!$topic->slug) {

            // 推送任务到队列
            dispatch(new TranslateSlug($topic));
        }
    }

    public function deleted(Topic $topic)
    {
        \DB::table('replies')->where('topic_id', $topic->id)->delete();
    }

    public function created(Topic $topic)
    {
        $user_ids = $topic->user->followers->pluck('id')->toArray();
        $users=User::whereIn('id', $user_ids)->get();    
    
        foreach ($users as $user){
            $user ->notify(new CreateTopic($topic));
          }
       
    }
}
