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
        Schema::create('matriculation_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matriculation_period_id')->constrained('matriculation_periods')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('matriculation_aspects', function (Blueprint $table) {
            $table->foreignId('matriculation_skill_id')->nullable()->after('matriculation_period_id')->constrained('matriculation_skills')->onDelete('cascade');
        });

        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreignId('matriculation_skill_id')->nullable()->after('leader_registration_id')->constrained('matriculation_skills')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropForeign(['matriculation_skill_id']);
            $table->dropColumn('matriculation_skill_id');
        });

        Schema::table('matriculation_aspects', function (Blueprint $table) {
            $table->dropForeign(['matriculation_skill_id']);
            $table->dropColumn('matriculation_skill_id');
        });

        Schema::dropIfExists('matriculation_skills');
    }
};
