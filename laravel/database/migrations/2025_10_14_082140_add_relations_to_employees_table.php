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
        Schema::table('employees', function (Blueprint $table) {
            // Tambahkan kolom hanya jika belum ada
            if (!Schema::hasColumn('employees', 'department_id')) {
                $table->foreignId('department_id')
                      ->nullable()
                      ->constrained('departments')
                      ->nullOnDelete();
            }

            if (!Schema::hasColumn('employees', 'position_id')) {
                $table->foreignId('position_id')
                      ->nullable()
                      ->constrained('positions')
                      ->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            if (Schema::hasColumn('employees', 'department_id')) {
                $table->dropForeign(['department_id']);
                $table->dropColumn('department_id');
            }

            if (Schema::hasColumn('employees', 'position_id')) {
                $table->dropForeign(['position_id']);
                $table->dropColumn('position_id');
            }
        });
    }
};
