<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
  * イベントモデルのデータベーステーブル構築
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
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pref_code')->nullable();
            $table->string('record_id', 16);
            $table->string('pref_name', 8)->nullable();
            $table->string('city_name', 12)->nullable();
            $table->string('event_name', 255);
            $table->string('event_kana', 255)->nullable();
            $table->string('event_en', 255)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('start_time', 8)->nullable();
            $table->string('end_time', 8)->nullable();
            $table->text('start_memo')->nullable();
            $table->text('description')->nullable();
            $table->string('fee_basic', 20)->nullable();
            $table->text('fee_detail')->nullable();
            $table->text('contact_name')->nullable();
            $table->string('contact_tel', 64)->nullable();
            $table->string('contact_tel_ext', 20)->nullable();
            $table->string('organizer', 64)->nullable();
            $table->string('location_name', 128)->nullable();
            $table->string('address', 128)->nullable();
            $table->string('address2', 32)->nullable();
            $table->string('lat', 14)->nullable();
            $table->string('lng', 14)->nullable();
            $table->text('access')->nullable();
            $table->string('parking', 60)->nullable();
            $table->text('capacity')->nullable();
            $table->string('entry_due_date', 10)->nullable();
            $table->string('entry_due_time', 32)->nullable();
            $table->text('entry_method')->nullable();
            $table->text('entry_url')->nullable();
            $table->text('memo')->nullable();
            $table->string('category', 12)->nullable();
            $table->string('ward_name', 12)->nullable();
            $table->date('open_date')->nullable();
            $table->date('update_date')->nullable();
            $table->string('is_childcare', 4)->nullable();
            $table->string('location_no', 16)->nullable();
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->dateTime('deleted_at')->nullable();

            $table->index(['event_name'], 'sp_idx1');
            $table->comment('イベント');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
