<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelangganTable extends Migration
{
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id('id_pelanggan'); // Primary Key
            $table->string('nama'); // Nama Pelanggan
            $table->string('email')->unique(); // Email unik
            $table->string('no_telepon'); // Nomor telepon
            $table->text('alamat'); // Alamat pelanggan
            $table->integer('point')->nullable(); // Kolom point dibuat nullable
            $table->date('tanggal_bergabung')->default(now()); // Default ke tanggal saat ini
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggans'); // Hapus tabel saat rollback
    }
}