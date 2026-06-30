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
        if (Schema::hasColumn('teacher_kpi_periods', 'user_id')) {
            Schema::table('teacher_kpi_periods', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }

        Schema::dropIfExists('teacher_kpi_logs');

        Schema::create('teacher_kpi_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('teacher_kpi_item_id')->constrained('teacher_kpi_items')->onDelete('cascade');
            $table->date('date');
            $table->boolean('is_checked')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'teacher_kpi_item_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_kpi_logs');

        Schema::create('teacher_kpi_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_kpi_item_id')->constrained('teacher_kpi_items')->onDelete('cascade');
            $table->date('date');
            $table->boolean('is_checked')->default(false);
            $table->timestamps();

            $table->unique(['teacher_kpi_item_id', 'date']);
        });

        Schema::table('teacher_kpi_periods', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
        });
    }
};
