<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('education_students', function (Blueprint $table) {
            $table->enum('career_status', ['active', 'passed', 'failed', 'resigned'])->default('active')->after('career_end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('education_students', function (Blueprint $table) {
            $table->dropColumn('career_status');
        });
    }
};
