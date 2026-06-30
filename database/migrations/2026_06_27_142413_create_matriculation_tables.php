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
        Schema::create('matriculation_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->constrained('academic_years')->onDelete('cascade');
            $table->foreignId('batch_id')->constrained('batches')->onDelete('cascade');
            $table->integer('duration_number');
            $table->string('duration_unit'); // 'days', 'weeks', 'months'
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });

        Schema::create('matriculation_aspects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matriculation_period_id')->constrained('matriculation_periods')->onDelete('cascade');
            $table->string('name');
            $table->integer('weight_percentage');
            $table->timestamps();
        });

        Schema::create('matriculation_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('registrations')->onDelete('cascade');
            $table->foreignId('matriculation_period_id')->constrained('matriculation_periods')->onDelete('cascade');
            $table->foreignId('classroom_id')->nullable()->constrained('classrooms')->onDelete('set null');
            $table->string('status')->default('active'); // 'active', 'passed', 'failed', 'resigned'
            $table->timestamps();
        });

        Schema::create('matriculation_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matriculation_student_id')->constrained('matriculation_students')->onDelete('cascade');
            $table->foreignId('matriculation_aspect_id')->constrained('matriculation_aspects')->onDelete('cascade');
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
        Schema::dropIfExists('matriculation_scores');
        Schema::dropIfExists('matriculation_students');
        Schema::dropIfExists('matriculation_aspects');
        Schema::dropIfExists('matriculation_periods');
    }
};
