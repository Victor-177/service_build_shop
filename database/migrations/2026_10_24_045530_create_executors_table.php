<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('executors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название бригады
            $table->text('description')->nullable(); // Описание
            $table->string('phone'); // Телефон
            $table->string('email')->nullable(); // Email
            $table->boolean('is_active')->default(true); // Статус
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('executors');
    }
};