<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('price', 12, 0);
            $table->integer('warranty')->nullable();
            $table->string('is_waterproof')->nullable();
            $table->string('glasses')->nullable();
            $table->string('strap')->nullable();
            $table->string('watch_case')->nullable();
            $table->string('image');
            $table->text('image_detail')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedSmallInteger('id_brand');
            $table->unsignedSmallInteger('id_category');
            $table->timestamps();

            $table->foreign('id_brand')->references('id')->on('brand');
            $table->foreign('id_category')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
