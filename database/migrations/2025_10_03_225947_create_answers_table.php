<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('answers', function (Blueprint $table) {
        $table->id();
        $table->foreignId('question_id')->constrained()->onDelete('cascade');
        $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade'); // Docteur qui répond
        $table->text('body');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
