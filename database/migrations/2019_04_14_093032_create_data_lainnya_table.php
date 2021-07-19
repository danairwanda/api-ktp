<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataLainnyaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_lainnya', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pendidikan');
            $table->string('penghasilan');
            $table->string('sumber_penghasilan');
            $table->string('tujuan_investasi');
            $table->integer('green_card')->nullalble();
            $table->integer('profil_resiko');
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
        Schema::dropIfExists('data_lainnya');
    }
}
