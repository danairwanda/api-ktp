<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataAkunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_akun', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sid')->nullable();
            $table->string('nik');
            $table->string('nama');
            $table->string('email');
            $table->string('phone');
            $table->tinyInteger('status')->default(0);
            $table->date('tanggal_lahir');
            $table->string('ktp');
            $table->string('kode_referal')->nullable();
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
        Schema::dropIfExists('data_akun');
    }
}
