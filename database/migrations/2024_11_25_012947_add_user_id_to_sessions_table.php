<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToSessionsTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Tambahkan kolom 'user_id' jika belum ada
            if (!Schema::hasColumn('sessions', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Batalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Hapus foreign key hanya jika kolom 'user_id' ada
            if (Schema::hasColumn('sessions', 'user_id')) {
                $table->dropForeign(['user_id']); // Drop the foreign key
                $table->dropColumn('user_id'); // Drop the user_id column
            }
        });
    }
}
