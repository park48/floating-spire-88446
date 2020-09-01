<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_id');
            $table->string('body');      // string型のbodyという名前のテーブルを作成。
            $table->timestamps();
            $table
              ->foreign('post_id')
              ->references('id')
              ->on('posts')        // postsテーブルのidだよという意味。
              ->onDelete('cascade');   //postが削除されたら関連するコメント全てを消す
        });                           // cascade=滝→関連するもの。
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
