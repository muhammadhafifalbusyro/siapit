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
            $table->string('gender')->nullable()->after('whatsapp');
            $table->integer('age')->nullable()->after('gender');
            $table->text('address')->nullable()->after('age');
            $table->string('last_education')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['gender', 'age', 'address', 'last_education']);
        });
    }
};
