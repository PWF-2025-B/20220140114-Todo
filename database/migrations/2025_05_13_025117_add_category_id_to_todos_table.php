<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('todos', function (Blueprint $table): void {
            // Cek dulu kalau belum ada kolom category_id
            if (!Schema::hasColumn('todos', 'category_id')) {
                $table->foreignId('category_id')
                    ->nullable()
                    ->constrained()
                    ->cascadeOnDelete();
            } else {
                // Kalau sudah ada tapi ingin pastikan nullable
                $table->foreignId('category_id')
                    ->nullable()
                    ->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            if (Schema::hasColumn('todos', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }
        });
    }
};
