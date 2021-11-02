<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('nav_article_id')->default(0)->comment('文章id');
            $table->unsignedInteger('parent_id')->default(0)->comment('评论人id');
            $table->unsignedInteger('target_id')->default(0)->comment('被回复人的id');
            $table->unsignedInteger('user_id')->default(0)->comment('回复人id');
            $table->text('content')->comment('内容');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_comment');
    }
}
