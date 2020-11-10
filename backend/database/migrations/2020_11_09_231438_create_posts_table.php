<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('post_id')
                  ->unsigned()
                  ->comment('投稿ID（保存順に自動裁判）');
            $table->foreignId('post_author')
                  ->constrained('users');
            $table->string('post_title', 200)
                  ->comment('タイトル');
            $table->longText('post_content')
                  ->comment('本文');
            $table->string('post_status',20)
                  ->default('publish')
                  ->comment('publish: 公開 private:非公開');
            $table->dateTime('post_date')
                  ->comment('投稿日時');
            $table->dateTime('post_modified')
                  ->comment('更新日時');
            $table->string('file_name')
                  ->comment('元のファイル名');
            $table->string('file_path')
                  ->comment('ファイルの保存先');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
