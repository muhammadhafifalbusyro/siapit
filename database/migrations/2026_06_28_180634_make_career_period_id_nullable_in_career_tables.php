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
        Schema::table('career_placements', function (Blueprint $table) {
            $table->dropForeign(['career_period_id']);
            $table->dropColumn('career_period_id');
        });

        Schema::table('career_placements', function (Blueprint $table) {
            $table->unsignedBigInteger('career_period_id')->nullable()->after('id');
        });

        Schema::table('education_students', function (Blueprint $table) {
            $table->foreignId('career_placement_id')->nullable()->constrained('career_placements')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('education_students', function (Blueprint $table) {
            $table->dropForeign(['career_placement_id']);
            $table->dropColumn('career_placement_id');
        });
    }
};
