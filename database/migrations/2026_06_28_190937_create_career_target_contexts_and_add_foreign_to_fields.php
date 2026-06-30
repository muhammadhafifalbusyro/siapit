<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('career_target_contexts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Clear existing fields first to avoid foreign key conflicts
        DB::table('career_target_fields')->truncate();

        Schema::table('career_target_fields', function (Blueprint $table) {
            $table->foreignId('career_target_context_id')->after('id')->constrained('career_target_contexts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('career_target_fields', function (Blueprint $table) {
            $table->dropForeign(['career_target_context_id']);
            $table->dropColumn('career_target_context_id');
        });

        Schema::dropIfExists('career_target_contexts');
    }
};
