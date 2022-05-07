<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldNameProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->renameColumn('chongnuoc', 'is_waterproof');
            $table->renameColumn('chatlieukinh', 'glasses');
            $table->renameColumn('chatlieuday', 'strap');
            $table->renameColumn('chatlieuvo', 'watch_case');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->renameColumn('is_waterproof', 'chongnuoc');
            $table->renameColumn('glasses', 'chatlieukinh');
            $table->renameColumn('strap', 'chatlieuday');
            $table->renameColumn('watch_case', 'chatlieuvo');
        });
    }
}
