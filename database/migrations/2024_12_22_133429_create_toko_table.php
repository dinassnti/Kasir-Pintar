<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokoTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('toko')) {
            Schema::create('toko', function (Blueprint $table) {
                $table->id('id_toko');
                $table->unsignedBigInteger('id_user');
                $table->string('jenis_usaha', 50);
                $table->string('nama_toko', 50);
                $table->string('email')->unique();
                $table->string('no_telepon');
                $table->text('alamat');
                $table->string('foto_toko', 255)->nullable();
                $table->timestamps();
    
            // Foreign key constraint
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }
    }
    
    public function down()
    {
        Schema::dropIfExists('toko');
    }    
}
