<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToFolders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()
            ->nullable();

            // 外部キーを設定する
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('folders', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()
            ->nullable(false)->change();
        });
        // Schema::table('folders', function (Blueprint $table) {
        //     $table->integer('user_id')->unsigned()->nullable(false)->change();
        //
        //     // 外部キーを設定する
        //     $table->foreign('user_id')->references('id')->on('users');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
