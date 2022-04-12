<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_product2', function (Blueprint $table) {
            $table->id();
            $table->text('BANNER')->nullable();
            $table->text('UPC')->nullable();
            $table->text('newParent')->nullable();
            $table->text('newBrand')->nullable();
            $table->text('PRODUCT')->nullable();
            $table->text('Category')->nullable();
            $table->text('SubCategory1')->nullable();
            $table->text('SubCategory2')->nullable();
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
        //
    }
}
