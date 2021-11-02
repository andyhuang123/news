<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('appId')->index()->comment('小程序appid');
            $table->string('activity_id')->comment('活动id');
            $table->string('activity_title')->comment('活动名称');
            $table->string('image')->comment('活动图片');
            $table->tinyInteger('is_open')->default(1)->comment('活动是否启用【1启用0关闭】');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity');
    }
}
