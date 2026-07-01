<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classroom_assistant_teachers', function (Blueprint $table) {
            $table->unsignedBigInteger('classroom_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(['classroom_id', 'user_id']);
        });

        // Migrate existing single assistant_teacher_id data to pivot table
        if (Schema::hasColumn('classrooms', 'assistant_teacher_id')) {
            $classrooms = \Illuminate\Support\Facades\DB::table('classrooms')
                ->whereNotNull('assistant_teacher_id')
                ->select('id', 'assistant_teacher_id')
                ->get();

            foreach ($classrooms as $classroom) {
                \Illuminate\Support\Facades\DB::table('classroom_assistant_teachers')->insertOrIgnore([
                    'classroom_id' => $classroom->id,
                    'user_id'      => $classroom->assistant_teacher_id,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('classroom_assistant_teachers');
    }
};
