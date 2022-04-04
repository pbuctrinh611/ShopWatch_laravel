<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_colors', function (Blueprint $table) {
            $table->unsignedBigInteger('id_product');
            $table->unsignedSmallInteger('id_color');
            $table->decimal('price_plus', 12, 0);
            $table->integer('qty')->default(0);
            $table->timestamps();

            $table->foreign('id_product')->references('id')->on('product');
            $table->foreign('id_color')->references('id')->on('color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_colors');
    }
}
