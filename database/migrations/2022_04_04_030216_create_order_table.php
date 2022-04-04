<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_customer')->nullable();
            $table->unsignedBigInteger('id_saler')->nullable();
            $table->unsignedBigInteger('id_shipper')->nullable();
            $table->string('name');
            $table->string('tel');
            $table->unsignedSmallInteger('id_district')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('order_at');
            $table->dateTime('confirm_at')->nullable();
            $table->dateTime('receive_at')->nullable();
            $table->dateTime('cancel_at')->nullable();
            $table->decimal('total_money', 12, 0)->nullable();
            $table->decimal('ship_money', 10, 0)->nullable();
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('id_customer')->references('id')->on('users');
            $table->foreign('id_saler')->references('id')->on('users');
            $table->foreign('id_shipper')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
