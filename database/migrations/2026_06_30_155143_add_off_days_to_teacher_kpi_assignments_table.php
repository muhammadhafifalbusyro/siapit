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
        if (Schema::hasTable('teacher_kpi_assignments')) {
            if (!Schema::hasColumn('teacher_kpi_assignments', 'off_days')) {
                Schema::table('teacher_kpi_assignments', function (Blueprint $table) {
                    $table->text('off_days')->nullable()->after('teacher_kpi_item_id');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('teacher_kpi_assignments')) {
            if (Schema::hasColumn('teacher_kpi_assignments', 'off_days')) {
                Schema::table('teacher_kpi_assignments', function (Blueprint $table) {
                    $table->dropColumn('off_days');
                });
            }
        }
    }
};
