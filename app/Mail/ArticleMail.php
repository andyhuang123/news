<?php

namespace App\Mail;

use App\Models\BlogNavArticle;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticleMail extends Mailable
{
    use Queueable, SerializesModels;

    //文章实例
    protected $article;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BlogNavArticle $blogArticle)
    {
        $this->article = $blogArticle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $article_title = $this->article->getAttributeValue('article_title');
        $aid           = $this->article->getAttributeValue('id');
        $show_desc =  $this->article->getAttributeValue('article_describe');
        return $this
            ->from('356300546@qq.com', 'coding')
            ->subject(config('base.website_title') . '-订阅文章更新-' . date('Y-m-d'))
            ->view('mail.index')
            ->with([
                'title' => $article_title,
                'url'   => url('/article_details', ['aid' => $aid]),
                'show_desc'=>$show_desc
            ]);
    }
}
