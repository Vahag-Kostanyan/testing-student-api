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
        Schema::create('group', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable(true);
            $table->foreignId('user_id')->nullable(false);
            $table->foreignId('group_type_id')->nullable(false);
            $table->string('name')->unique()->nullable(false);
            $table->string('description')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('group_type_id');
        });
        Schema::dropIfExists('group');
    }
};
