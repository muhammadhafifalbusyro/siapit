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
            $table->string('type')->default('character'); // 'character' or 'skill'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matriculation_aspects', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
