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
        Schema::create('education_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_period_id')->constrained('education_periods')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('education_aspects', function (Blueprint $table) {
            $table->foreignId('education_skill_id')->nullable()->after('education_period_id')->constrained('education_skills')->onDelete('cascade');
        });

        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreignId('education_skill_id')->nullable()->after('matriculation_skill_id')->constrained('education_skills')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropForeign(['education_skill_id']);
            $table->dropColumn('education_skill_id');
        });

        Schema::table('education_aspects', function (Blueprint $table) {
            $table->dropForeign(['education_skill_id']);
            $table->dropColumn('education_skill_id');
        });

        Schema::dropIfExists('education_skills');
    }
};
