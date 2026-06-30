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
        Schema::create('teacher_kpi_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });

        Schema::create('teacher_kpi_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_kpi_period_id')->constrained('teacher_kpi_periods')->onDelete('cascade');
            $table->string('name');
            $table->integer('weight');
            $table->timestamps();
        });

        Schema::create('teacher_kpi_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_kpi_item_id')->constrained('teacher_kpi_items')->onDelete('cascade');
            $table->date('date');
            $table->boolean('is_checked')->default(false);
            $table->timestamps();

            $table->unique(['teacher_kpi_item_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_kpi_logs');
        Schema::dropIfExists('teacher_kpi_items');
        Schema::dropIfExists('teacher_kpi_periods');
    }
};
