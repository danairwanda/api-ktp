<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataAlamatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_alamat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('negara');
            $table->string('kode_pos');
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
        Schema::dropIfExists('data_alamat');
    }
}
