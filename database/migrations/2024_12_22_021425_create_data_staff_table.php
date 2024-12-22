<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataStaffTable extends Migration
{
    public function up()
    {
        Schema::create('data_staff', function (Blueprint $table) {
            $table->id('id_data_staff');
            $table->foreignId('id_user')->constrained('users'); // Relasi dengan tabel users
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_telepon');
            $table->text('alamat');
            $table->string('password');
            $table->enum('level_akses', ['Kasir']);
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_staff');
    }
}
