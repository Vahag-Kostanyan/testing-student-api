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
        Schema::create('user_test', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->nullable(false);
            $table->foreignId('user_id')->nullable(false);
            $table->enum('status', ['pending', 'cancel', 'success', 'failed'])->default('pending')->nullable(false);
            $table->string('mark')->nullable(true);
            $table->dateTime('test_data_from')->nullable(false);
            $table->dateTime('test_data_to')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_test');
    }
};
