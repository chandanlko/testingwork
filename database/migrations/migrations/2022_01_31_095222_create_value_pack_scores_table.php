<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuePackScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('value_pack_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->references('parent_id')->on('parents');
            $table->integer('value_packid_1')->nullable();
            $table->integer('value_packid_2')->nullable();
            $table->integer('value_packid_3')->nullable();
            $table->integer('value_packid_4')->nullable();
            $table->integer('value_packid_5')->nullable();
            $table->integer('value_packid_6')->nullable();
            $table->integer('value_packid_7')->nullable();
            $table->integer('value_packid_8')->nullable();
            $table->integer('value_packid_9')->nullable();
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
        Schema::dropIfExists('value_pack_scores');
    }
}
