<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('executor_categories', function (Blueprint $table) {
            $table->id();
            // Привязка к исполнителю (бригаде)
            $table->foreignId('executor_id')->constrained()->cascadeOnDelete();
            // Привязка к категории
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            
            // Одна бригада не может быть привязана к одной категории дважды
            $table->unique(['executor_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('executor_categories');
    }
};