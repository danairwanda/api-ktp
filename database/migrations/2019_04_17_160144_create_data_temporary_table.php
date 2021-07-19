<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTemporaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // new table
    public function up()
    {
        Schema::create('data_temporary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image');
            $table->string('file');
            $table->tinyInteger('request_success')->default(0);
            $table->tinyInteger('request_failed')->default(0);
            $table->string('ip_address');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_temporary');
    }
}
