<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_bank', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_bank');
            $table->string('cabang_bank');
            $table->string('no_rekening');
            $table->string('nama_pemilik');
            $table->string('mata_uang');
            $table->integer('id_data_akun')->unsigned();
            $table->foreign('id_data_akun')->references('id')->on('data_akun');
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
        Schema::dropIfExists('data_bank');
    }
}
