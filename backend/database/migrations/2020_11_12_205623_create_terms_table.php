<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->bigIncrements('term_id')
                  ->unsigned()
                  ->comment('タームID（保存順に自動採番）');
            $table->string('term_name', 100)
                  ->comment('カテゴリ名');
            $table->string('term_slug', 100)
                  ->unique()
                  ->comment('スラッグ');
            $table->longText('term_description')
                  ->comment('説明');
            $table->string('taxonomy')
                  ->comment('category:カテゴリ tag:タグ');
            $table->integer('parent')
                  ->unsigned()
                  ->comment('親子関係');
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
        Schema::dropIfExists('terms');
    }
}
