<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_product');
            $table->unsignedSmallInteger('id_color');

            $table->string('color');
            $table->integer('qty');
            $table->decimal('unit_cost', 12, 0);
            $table->timestamps();
            $table->primary(['id_order', 'id_product', 'id_color']);

            $table->foreign('id_order')->references('id')->on('order');
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
        Schema::dropIfExists('order_details');
    }
}
