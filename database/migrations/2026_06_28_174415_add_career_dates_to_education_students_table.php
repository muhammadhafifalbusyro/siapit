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
        Schema::table('education_students', function (Blueprint $table) {
            $table->date('career_start_date')->nullable();
            $table->date('career_end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('education_students', function (Blueprint $table) {
            $table->dropColumn(['career_start_date', 'career_end_date']);
        });
    }
};
