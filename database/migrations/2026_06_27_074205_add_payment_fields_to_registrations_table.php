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
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('payment_status')->default('pending')->after('status');
            $table->string('midtrans_order_id')->nullable()->after('payment_status');
            $table->string('snap_token')->nullable()->after('midtrans_order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'midtrans_order_id', 'snap_token']);
        });
    }
};
