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
        Schema::create('education_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->constrained('academic_years')->onDelete('cascade');
            $table->foreignId('batch_id')->constrained('batches')->onDelete('cascade');
            $table->integer('duration_number')->nullable();
            $table->string('duration_unit')->nullable(); // 'days', 'weeks', 'months'
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });

        Schema::create('education_aspects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_period_id')->constrained('education_periods')->onDelete('cascade');
            $table->string('name');
            $table->integer('weight_percentage');
            $table->string('type')->default('character'); // 'character' or 'skill'
            $table->string('input_type')->default('score'); // 'checklist', 'score', 'counter'
            $table->decimal('target_weekly', 8, 2)->default(0);
            $table->decimal('target_monthly', 8, 2)->default(0);
            $table->text('active_days')->nullable();
            $table->timestamps();
        });

        Schema::create('education_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('registrations')->onDelete('cascade');
            $table->foreignId('education_period_id')->constrained('education_periods')->onDelete('cascade');
            $table->foreignId('classroom_id')->nullable()->constrained('classrooms')->onDelete('set null');
            $table->string('status')->default('active'); // 'active', 'passed', 'failed', 'resigned'
            $table->timestamps();
        });

        Schema::create('education_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_student_id')->constrained('education_students')->onDelete('cascade');
            $table->foreignId('education_aspect_id')->constrained('education_aspects')->onDelete('cascade');
            $table->decimal('score', 5, 2);
            $table->date('evaluation_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_scores');
        Schema::dropIfExists('education_students');
        Schema::dropIfExists('education_aspects');
        Schema::dropIfExists('education_periods');
    }
};
