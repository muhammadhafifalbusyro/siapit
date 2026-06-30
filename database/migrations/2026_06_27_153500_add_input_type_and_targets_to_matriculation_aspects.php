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
        Schema::table('matriculation_aspects', function (Blueprint $table) {
            $table->string('input_type')->default('score'); // 'checklist' or 'score'
            $table->decimal('target_weekly', 8, 2)->default(0);
            $table->decimal('target_monthly', 8, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matriculation_aspects', function (Blueprint $table) {
            $table->dropColumn(['input_type', 'target_weekly', 'target_monthly']);
        });
    }
};
