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
        Schema::table('matriculation_periods', function (Blueprint $table) {
            $table->integer('duration_number')->nullable()->change();
            $table->string('duration_unit')->nullable()->change();
            $table->date('start_date')->nullable(false)->change();
            $table->date('end_date')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matriculation_periods', function (Blueprint $table) {
            $table->integer('duration_number')->nullable(false)->change();
            $table->string('duration_unit')->nullable(false)->change();
            $table->date('start_date')->nullable()->change();
            $table->date('end_date')->nullable()->change();
        });
    }
};
