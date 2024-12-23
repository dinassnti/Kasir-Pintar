<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasColumn('sessions', 'id_user')) {
            Schema::table('sessions', function (Blueprint $table) {
                $table->unsignedBigInteger('id_user')->nullable()->after('id');
            });
        }
    }
    
    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropColumn('id_user');
        });
    }
};
