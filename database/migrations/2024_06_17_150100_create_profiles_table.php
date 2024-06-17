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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->default('');
            $table->string('second_name')->default('');
            $table->string('third_name')->default('');
            $table->string('phone')->default('');
            $table->unsignedSmallInteger('status')->default(1);
            $table->unsignedSmallInteger('age')->nullable();
            $table->string('login')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
