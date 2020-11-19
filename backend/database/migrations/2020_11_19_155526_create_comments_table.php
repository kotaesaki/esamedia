<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('comment_id')
                ->unsigned()
                ->comment('コメントID（自動採番）');
            $table->foreignId('comment_post_id')
                ->constrained('posts.post_id')
                ->comment('post_id');
            $table->string('comment_author', 100)
                ->comment('コメント投稿者');
            $table->string('comment_author_email', 100)
                ->comment('コメント投稿者のメールアドレス');
            $table->string('comment_author_url', 200)
                ->comment('コメント投稿者のURL');
            $table->longText('comment_content')
                ->comment('コメント内容');
            $table->string('comment_author_ip', 100)
                ->comment('コメント投稿者のIPアドレス');
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
        Schema::dropIfExists('comments');
    }
}
