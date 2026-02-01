<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
  * ごみ分別モデルのデータベーステーブル構築
  */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gomi_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kana1', 4)->nullable();
            $table->string('name', 64);
            $table->string('detail', 64)->nullable();
            $table->string('size', 64)->nullable();
            $table->string('gomi_type', 64)->nullable();
            $table->integer('fee')->nullable();
            $table->text('description')->nullable();
            $table->text('howto')->nullable();
            $table->text('words')->nullable();
            $table->text('url')->nullable();
            $table->text('memo')->nullable();
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->dateTime('deleted_at')->nullable();

            $table->index(['name'], 'gm_idx1');
            $table->comment('ごみ分別');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gomi_items');
    }
};
