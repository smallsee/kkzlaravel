<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_id')->default('未知分类')->comment('分类');
            $table->integer('user_id')->unsigned()->default(0);
            $table->string('title',200)->default('');
            $table->text('desc');
            $table->text('thumb')->comment('缩略图');
            $table->integer('num')->default(0);
            $table->decimal('price',10,2)->default(00000000.00);
            $table->boolean('is_sale')->default(false)->comment('是否最新动漫');
            $table->decimal('sale_price',10,2)->default(00000000.00);
            $table->boolean('is_hot')->default(false)->comment('是否最新动漫');
            $table->integer('status')->default(0)->comment('视频状态');
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
        Schema::dropIfExists('shops');
    }
}
