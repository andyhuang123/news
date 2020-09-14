<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedTypesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $types=[
            [
                'name'=>'公告',
                'description'=>'通知公告',
            ],
            [
                'name'=>'帖子',
                'description'=>'发布帖子',
            ],
            [
                'name'=>'文章',
                'description'=>'发布文章',
            ],
        ];
        DB::table('types')->insert($types);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('types')->truncate();
    }
}
