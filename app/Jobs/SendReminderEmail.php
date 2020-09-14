<?php

namespace App\Jobs;

use App\Mail\ArticleMail;
use App\Models\BlogNavArticle;
use App\Models\BlogSubscribe;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;


class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 任务可以尝试的最大次数。
     *
     * @var int
     */
    private $tries = 3;

    /**
     * 任务可以执行的最大秒数 (超时时间)。
     *
     * @var int
     */
    private $timeout = 30;

    /**
     * 文章内容实例模型
     */
    protected $blogNavArticle;


    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(BlogNavArticle $blogNavArticle,$email)
    {
        $this->blogNavArticle = $blogNavArticle;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void $this->email
     */
    public function handle()
    {
        Mail::to($this->email)->send(new ArticleMail($this->blogNavArticle));
        
    }
}
