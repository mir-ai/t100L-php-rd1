<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
  * 人口モデルのデータベーステーブル構築
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
        Schema::create('populations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pref_code');
            $table->string('pref_name', 16);
            $table->string('city_name', 16);
            $table->string('yyyymm', 16);
            $table->integer('ward_code');
            $table->string('ward_name', 16);
            $table->string('district_name', 16);
            $table->integer('oaza_code');
            $table->string('oaza_name', 16)->nullable();
            $table->string('age', 16);
            $table->integer('total_count')->default(0);
            $table->integer('male_count')->default(0);
            $table->integer('female_count')->default(0);
            $table->text('description')->nullable();
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->dateTime('deleted_at')->nullable();

            $table->unique(['pref_code', 'city_name', 'ward_code', 'oaza_code', 'age'], 'pp_idx1');
            $table->comment('人口');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('populations');
    }
};
