<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // HAPUS FOREIGN KEY DULU
            $table->dropForeign(['user_id']);

            // BARU HAPUS KOLOM
            $table->dropColumn('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
        });
    }
};
