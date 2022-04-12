<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerValuePacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_value_packs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('value_pack_1')->nullable();
            $table->foreign('value_pack_1')->references('values_pack_id')->on('values_packs');
            $table->unsignedBigInteger('value_pack_2')->nullable();;
            $table->foreign('value_pack_2')->references('values_pack_id')->on('values_packs');
            $table->unsignedBigInteger('value_pack_3')->nullable();;
            $table->foreign('value_pack_3')->references('values_pack_id')->on('values_packs');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('customer_value_packs');
    }
}
