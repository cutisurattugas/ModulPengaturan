<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePejabatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pejabat', function (Blueprint $table) {
            $table->id();
            $table->date('periode_mulai');
            $table->date('periode_selesai');
            $table->boolean('status');
            $table->string('sk');
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('jabatan_id');
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pejabat');
    }
}
