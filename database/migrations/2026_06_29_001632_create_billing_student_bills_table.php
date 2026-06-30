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
        Schema::create('billing_student_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->onDelete('cascade');
            $table->foreignId('billing_category_id')->constrained('billing_categories')->onDelete('cascade');
            $table->boolean('is_billed')->default(true);
            $table->timestamps();
            
            $table->unique(['registration_id', 'billing_category_id'], 'reg_cat_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_student_bills');
    }
};
