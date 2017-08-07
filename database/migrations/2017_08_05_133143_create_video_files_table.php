<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name')->default('未知名称')->comment('标题');
            $table->string('file_thumb')->default('/images/avatar.png')->comment('缩略图');
            $table->string('file_url')->default('未知地址')->comment('地址');
            $table->integer('video_id')->unsigned()->index();
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
        Schema::dropIfExists('video_files');
    }
}
