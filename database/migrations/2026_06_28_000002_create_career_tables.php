<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->constrained('academic_years')->onDelete('cascade');
            $table->foreignId('batch_id')->constrained('batches')->onDelete('cascade');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->timestamps();
        });

        Schema::create('career_placements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_period_id')->constrained('career_periods')->onDelete('cascade');
            $table->string('name');
            $table->string('mentor_name')->nullable();
            $table->string('mentor_contact')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('career_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_period_id')->constrained('career_periods')->onDelete('cascade');
            $table->foreignId('registration_id')->constrained('registrations')->onDelete('cascade');
            $table->foreignId('career_placement_id')->nullable()->constrained('career_placements')->onDelete('set null');
            $table->enum('status', ['active', 'passed', 'failed', 'resigned'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('career_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_student_id')->constrained('career_students')->onDelete('cascade');
            $table->date('log_date');
            $table->text('task');
            $table->text('progress')->nullable();
            $table->text('obstacles')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });

        Schema::create('career_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_student_id')->constrained('career_students')->onDelete('cascade');
            $table->foreignId('evaluator_id')->constrained('users')->onDelete('cascade');
            $table->date('evaluation_date');
            $table->decimal('soft_skill_communication', 5, 2)->default(0.00);
            $table->decimal('soft_skill_teamwork', 5, 2)->default(0.00);
            $table->decimal('soft_skill_discipline', 5, 2)->default(0.00);
            $table->decimal('hard_skill_quality', 5, 2)->default(0.00);
            $table->decimal('hard_skill_speed', 5, 2)->default(0.00);
            $table->decimal('hard_skill_problem_solving', 5, 2)->default(0.00);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('career_portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_student_id')->constrained('career_students')->onDelete('cascade');
            $table->string('title');
            $table->string('project_url')->nullable();
            $table->string('repo_url')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_portfolios');
        Schema::dropIfExists('career_scores');
        Schema::dropIfExists('career_logs');
        Schema::dropIfExists('career_students');
        Schema::dropIfExists('career_placements');
        Schema::dropIfExists('career_periods');
    }
};
