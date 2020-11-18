<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_term', function (Blueprint $table) {
            $table->bigInteger('post_id')
                  ->unsigned()
                  ->comment('記事ID');
            $table->bigInteger('term_id')
                  ->unsigned()
                  ->comment('タームID');
            $table->primary(['post_id', 'term_id']);

            $table->foreign('post_id')
                ->references('post_id')
                ->on('posts')
                ->onDelete('cascade');
            $table->foreign('term_id')
                ->references('term_id')
                ->on('terms')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_term');
    }
}
