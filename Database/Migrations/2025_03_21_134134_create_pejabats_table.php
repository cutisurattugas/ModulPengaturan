<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePejabatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pejabats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('jabatan_id')->nullable();
            $table->date('mulai')->nullable();
            $table->date('selesai')->nullable();
            $table->char('SK', 150)->nullable();
            $table->unsignedBigInteger('pegawai_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->enum('status', ['Aktif', 'Non Aktif'])->default('Aktif');

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
        Schema::dropIfExists('pejabats');
    }
}
