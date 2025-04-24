<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('nama');
            $table->integer('staff')->nullable();
            $table->unsignedBigInteger('jurusan')->nullable();
            $table->unsignedBigInteger('prodi')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('gelar_dpn')->nullable();
            $table->string('gelar_blk')->nullable();
            $table->string('status_karyawan')->nullable(); // pakai string karena datanya string
            $table->string('username')->nullable();
            $table->string('noid')->nullable();
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
        Schema::dropIfExists('pegawai');
    }
}
