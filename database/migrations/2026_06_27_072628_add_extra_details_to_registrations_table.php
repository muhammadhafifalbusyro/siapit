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
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('goals')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->text('organization_experience')->nullable();
            $table->string('school_name')->nullable();
            $table->string('school_major')->nullable();
            $table->text('achievements')->nullable();
            $table->string('parents_condition')->nullable();
            $table->string('parent_income')->nullable();
            $table->integer('sibling_count')->nullable();
            $table->string('has_laptop')->nullable();
            $table->string('quran_memorization')->nullable();
            $table->string('favorite_ustadz')->nullable();
            $table->string('has_relationship')->nullable();
            $table->string('source_info')->nullable();
            $table->string('has_bpjs')->nullable();
            $table->string('idol')->nullable();
            $table->string('is_smoking')->nullable();
            $table->string('learned_before')->nullable();
            $table->text('it_skills')->nullable();
            $table->string('favorite_subjects')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn([
                'goals', 'hobbies', 'instagram', 'facebook', 'organization_experience',
                'school_name', 'school_major', 'achievements', 'parents_condition',
                'parent_income', 'sibling_count', 'has_laptop', 'quran_memorization',
                'favorite_ustadz', 'has_relationship', 'source_info', 'has_bpjs',
                'idol', 'is_smoking', 'learned_before', 'it_skills', 'favorite_subjects'
            ]);
        });
    }
};
