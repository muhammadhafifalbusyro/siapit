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
        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreignId('homeroom_teacher_id')->nullable()->after('name')->constrained('users')->onDelete('set null');
            $table->foreignId('assistant_teacher_id')->nullable()->after('homeroom_teacher_id')->constrained('users')->onDelete('set null');
            $table->foreignId('leader_registration_id')->nullable()->after('assistant_teacher_id')->constrained('registrations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropForeign(['homeroom_teacher_id']);
            $table->dropForeign(['assistant_teacher_id']);
            $table->dropForeign(['leader_registration_id']);
            $table->dropColumn(['homeroom_teacher_id', 'assistant_teacher_id', 'leader_registration_id']);
        });
    }
};
