<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('uploaded_by')->constrained('users')->cascadeOnDelete();
            $table->string('filename');
            $table->string('path');
            $table->string('mime');
            $table->bigInteger('size');
            $table->enum('status', ['pending','processing','done','failed'])->default('pending');
            $table->timestamps();
        });

        Schema::create('insights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->json('content')->nullable();
            $table->text('summary')->nullable();
            $table->float('confidence')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('insights');
        Schema::dropIfExists('files');
        Schema::dropIfExists('patients');
    }
};
