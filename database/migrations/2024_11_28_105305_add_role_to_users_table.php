<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                // Menambahkan kolom 'role' hanya dengan dua pilihan: Owner atau Staff
                $table->enum('role', ['Owner', 'Staff'])->default('Staff');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom 'role'
            $table->dropColumn('role');
        });
    }
}

