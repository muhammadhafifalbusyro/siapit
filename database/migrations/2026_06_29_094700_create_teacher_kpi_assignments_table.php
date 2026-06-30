<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Make teacher_kpi_period_id nullable in teacher_kpi_items
        Schema::table('teacher_kpi_items', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_kpi_period_id')->nullable()->change();
        });

        // Create teacher_kpi_assignments table
        Schema::create('teacher_kpi_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('teacher_kpi_period_id');
            $table->unsignedBigInteger('teacher_kpi_item_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('teacher_kpi_period_id')->references('id')->on('teacher_kpi_periods')->onDelete('cascade');
            $table->foreign('teacher_kpi_item_id')->references('id')->on('teacher_kpi_items')->onDelete('cascade');

            $table->unique(['user_id', 'teacher_kpi_period_id', 'teacher_kpi_item_id'], 'kpi_assignments_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_kpi_assignments');

        Schema::table('teacher_kpi_items', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_kpi_period_id')->nullable(false)->change();
        });
    }
};
