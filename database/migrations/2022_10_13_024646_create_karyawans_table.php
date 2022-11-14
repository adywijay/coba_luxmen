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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karyawan');
            $table->foreignId('jabatan_id')->constrained('jabatans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('akses_id')->constrained('hak_akses')->onDelete('cascade')->onUpdate('cascade');
            $table->year('tahun_masuk');
            $table->dateTime('tgl_masuk');
            $table->dateTime('tgl_keluar');
            $table->enum('status', ['Aktif', 'Nonaktif']);
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
        Schema::dropIfExists('karyawans');
    }
};