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
        Schema::dropIfExists('career_target_submission_values');
        Schema::dropIfExists('career_target_submissions');

        Schema::create('career_target_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_student_id')->constrained('education_students')->onDelete('cascade');
            $table->foreignId('career_target_context_id')->constrained('career_target_contexts')->onDelete('cascade');
            $table->integer('score')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('career_target_submission_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('career_target_submission_id');
            $table->unsignedBigInteger('career_target_field_id');
            $table->text('value')->nullable();
            $table->timestamps();

            $table->foreign('career_target_submission_id', 'fk_ctsv_submission_id')
                ->references('id')
                ->on('career_target_submissions')
                ->onDelete('cascade');

            $table->foreign('career_target_field_id', 'fk_ctsv_field_id')
                ->references('id')
                ->on('career_target_fields')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_target_submission_values');
        Schema::dropIfExists('career_target_submissions');
    }
};
