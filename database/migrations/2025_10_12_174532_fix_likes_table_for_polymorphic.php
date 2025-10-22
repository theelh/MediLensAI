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
    Schema::table('likes', function (Blueprint $table) {
        // ✅ Drop foreign key first
        if (Schema::hasColumn('likes', 'question_id')) {
            $table->dropForeign(['question_id']); // drop FK
            $table->dropColumn('question_id');    // then drop column
        }

        // ✅ Ensure polymorphic columns exist
        if (!Schema::hasColumn('likes', 'likeable_id')) {
            $table->unsignedBigInteger('likeable_id');
        }
        if (!Schema::hasColumn('likes', 'likeable_type')) {
            $table->string('likeable_type');
        }
    });
}


public function down(): void
{
    Schema::table('likes', function (Blueprint $table) {
        $table->foreignId('question_id')->nullable()->constrained()->cascadeOnDelete();
        $table->dropColumn(['likeable_id', 'likeable_type']);
    });
}

};
