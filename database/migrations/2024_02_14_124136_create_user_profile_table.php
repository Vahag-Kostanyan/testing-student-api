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
        Schema::create('user_profile', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false);
            $table->string('first_name')->nullable(true);
            $table->string('last_name')->nullable(true);
            $table->string('middke_name')->nullable(true);
            $table->integer('age')->nullable(true);
            $table->integer('courses')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profile');
    }
};
