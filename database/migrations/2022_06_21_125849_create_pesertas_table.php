<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_ujian')->unsigned();
            $table->string('peserta', 20);
            $table->integer('nilai');
            $table->timestamps();

            $table->foreign('id_ujian')->references('id')->on('ujians');
            $table->foreign('peserta')->references('nis')->on('siswas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesertas');
    }
}
