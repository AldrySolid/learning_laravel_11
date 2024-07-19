<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();

            $table->string('parent_class');
            $table->unsignedBigInteger('parent_id');

            $table->string('event');

            $table->jsonb('before')->default('{}');
            $table->jsonb('after')->default('{}');

            $table->timestamps();

            $table->index(['parent_class', 'parent_id']);
            $table->index(['event']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
