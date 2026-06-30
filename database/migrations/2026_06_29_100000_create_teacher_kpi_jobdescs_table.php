<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create teacher_kpi_jobdescs table
        Schema::create('teacher_kpi_jobdescs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Add teacher_kpi_jobdesc_id to teacher_kpi_items
        Schema::table('teacher_kpi_items', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_kpi_jobdesc_id')->nullable()->after('teacher_kpi_period_id');
            $table->foreign('teacher_kpi_jobdesc_id')->references('id')->on('teacher_kpi_jobdescs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('teacher_kpi_items', function (Blueprint $table) {
            $table->dropForeign(['teacher_kpi_jobdesc_id']);
            $table->dropColumn('teacher_kpi_jobdesc_id');
        });

        Schema::dropIfExists('teacher_kpi_jobdescs');
    }
};
