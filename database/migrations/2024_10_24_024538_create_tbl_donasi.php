<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_donasi', function (Blueprint $table) {
            $table->increments('donasi_id');
            $table->string('donasi_pj');
            $table->string('donasi_slug');
            $table->text('donasi_anggota');
            $table->string('donasi_lokasi');
            $table->string('donasi_alamat');
            $table->date('donasi_tanggal');
            $table->enum('donasi_keterangan', ['Sudah terlaksana', 'Belum terlaksana']);
            $table->bigInteger('donasi_jumlah')->nullable();
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
        Schema::dropIfExists('tbl_donasi');
    }
};
