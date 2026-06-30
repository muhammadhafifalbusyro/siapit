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
        Schema::create('billing_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('total_amount')->default(0);
            $table->integer('installment_count')->default(1);
            $table->timestamps();
        });

        Schema::create('billing_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_id');
            $table->unsignedBigInteger('billing_category_id');
            $table->integer('installment_index');
            $table->bigInteger('amount')->default(0);
            $table->timestamps();

            $table->foreign('registration_id', 'fk_bp_registration_id')
                  ->references('id')->on('registrations')
                  ->onDelete('cascade');
            $table->foreign('billing_category_id', 'fk_bp_category_id')
                  ->references('id')->on('billing_categories')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_payments');
        Schema::dropIfExists('billing_categories');
    }
};
