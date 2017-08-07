<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('未知标题')->comment('标题');
            $table->string('thumb')->default('/images/avatar.png')->comment('缩略图');
            $table->string('address')->default('未知地区')->comment('地区');
            $table->string('language')->default('未知语言')->comment('语言');
            $table->string('episodes')->default('未知集数')->comment('集数');
            $table->text('introduction')->comment('简介');
            $table->string('version')->default('未知版本')->comment('版本');
            $table->string('akira')->default('未知声优')->comment('声优');
            $table->string('tag')->default('未知类型')->comment('类型');
            $table->boolean('is_new')->default(false)->comment('是否最新动漫');
            $table->integer('status')->default(0)->comment('视频状态');
            $table->string('issue_date')->default('未知发行时间')->comment('发行时间');
            $table->string('update_date')->default('未知时间')->comment('发行时间');
            $table->integer('see')->default(0)->comment('观看人数');
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
        Schema::dropIfExists('videos');
    }
}
