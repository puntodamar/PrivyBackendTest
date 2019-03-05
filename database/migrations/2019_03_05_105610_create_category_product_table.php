<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('category_product');
        Schema::create('category_product', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
        });

        Schema::table('category_product', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('category_id')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
    }
}
