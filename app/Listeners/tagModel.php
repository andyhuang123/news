<?php

namespace App\Listeners;

use App\Events\TagEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Session\Store;

class tagModel
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
    public function handle(TagEvent $event)
    {
         
        $tag = $event->tag; // @todo: 当前标签
          
        foreach ($tag as $value){
            
           if (!$this->hasViewedBlog($value)) {
           
                //保存到数据库
                $value->tag_click = $value->tag_click + 1;
                $value->save();
                  //看过之后将保存到 Session 
                $this->storeViewedBlog($value); 
           }
        }
         
         
     
    }
    
    protected function hasViewedBlog($post)
    {
        return array_key_exists($post->id, $this->getViewedBlogs());
    }
    
    protected function getViewedBlogs()
    {
        return $this->session->get('viewed_Blogs_tag', []);
    }

    protected function storeViewedBlog($post)
    {
        $key = 'viewed_Blogs_tag.'.$post->id;

        $this->session->put($key, time());
    } 
    
}
