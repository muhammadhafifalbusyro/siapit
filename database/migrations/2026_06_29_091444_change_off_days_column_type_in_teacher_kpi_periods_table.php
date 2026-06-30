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
        Schema::table('teacher_kpi_periods', function (Blueprint $table) {
            $table->dropColumn('off_days');
        });

        Schema::table('teacher_kpi_periods', function (Blueprint $table) {
            $table->text('off_days')->nullable()->after('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teacher_kpi_periods', function (Blueprint $table) {
            $table->dropColumn('off_days');
        });

        Schema::table('teacher_kpi_periods', function (Blueprint $table) {
            $table->integer('off_days')->default(0)->after('end_date');
        });
    }
};
