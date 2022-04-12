<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatHierarchiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_hierarchies', function (Blueprint $table) {
            $table->bigIncrements('category_id');
            $table->string('category_name')->index('category_name');
            $table->string('sub_category1')->index('sub_category1');
            $table->string('sub_category2')->index('sub_category2');
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
        Schema::dropIfExists('cat_hierarchies');
    }
}
