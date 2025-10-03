<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['patient','doctor','admin'])->default('patient');
            $table->string('doctor_certificate')->nullable();
            $table->boolean('is_verified_doctor')->default(false);
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'doctor_certificate', 'is_verified_doctor']);
        });
    }
};

