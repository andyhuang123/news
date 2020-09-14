<?php

namespace App\Listeners;

use App\Events\OrderEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Session\Store;

class sendModel
{
    protected $session;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  OrderEvent  $event
     * @return void
     */
    public function handle(OrderEvent $event)
    {
         
        $article = $event->article; // @todo: 当前文章
        //@todo： 先进行判断是否已经查看过
        if (!$this->hasViewedBlog($article)) {
              //保存到数据库
            $article->article_click = $article->article_click + 1;
            $article->save();
              //看过之后将保存到 Session 
            $this->storeViewedBlog($article);
        } 
     
    }
    
    protected function hasViewedBlog($post)
    {
        return array_key_exists($post->id, $this->getViewedBlogs());
    }

    protected function getViewedBlogs()
    {
        return $this->session->get('viewed_Blogs', []);
    }

    protected function storeViewedBlog($post)
    {
        $key = 'viewed_Blogs.'.$post->id;

        $this->session->put($key, time());
    } 
    
}
