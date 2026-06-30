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
        Schema::create('career_student_incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_student_id')->constrained('education_students')->onDelete('cascade');
            $table->bigInteger('amount');
            $table->string('source');
            $table->date('date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_student_incomes');
    }
};
