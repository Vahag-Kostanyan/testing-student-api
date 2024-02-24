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
        Schema::create('test_question_answer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(false);
            $table->foreignId('test_id')->nullable(false);
            $table->foreignId('question_id')->nullable(false);
            $table->foreignId('answer_id')->nullable(false);
            $table->json('additional_information');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_question_answer');
    }
};
