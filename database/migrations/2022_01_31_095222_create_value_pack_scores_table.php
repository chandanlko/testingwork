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
            $table->unsignedBigInteger('parent_id')->nullable();;
            $table->foreign('parent_id')->references('parent_id')->on('parents');
            $table->unsignedBigInteger('value_pack_id')->nullable();
            $table->foreign('value_pack_id')->references('values_pack_id')->on('values_packs');
            $table->string('score')->nullable();
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
