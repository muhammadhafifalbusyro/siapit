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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('whatsapp');
            $table->string('birthplace')->nullable();
            $table->date('birthdate')->nullable();
            
            // Guardian / Wali info
            $table->string('guardian_name')->nullable();
            $table->string('guardian_relationship')->nullable();
            $table->string('guardian_whatsapp')->nullable();
            $table->string('guardian_occupation')->nullable();

            $table->foreignId('education_program_id')->constrained('education_programs')->onDelete('cascade');
            $table->foreignId('major_id')->constrained('majors')->onDelete('cascade');
            $table->string('status')->default('administrasi'); // administrasi, wawancara, penerimaan, ditolak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
