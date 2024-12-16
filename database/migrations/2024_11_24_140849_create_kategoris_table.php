<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategorisTable extends Migration
{
    public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id('id_kategori'); // Primary key
            $table->string('nama_kategori')->nullable(); // Nama kategori
            $table->timestamps(); // Timestamps created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori');
    }
}
