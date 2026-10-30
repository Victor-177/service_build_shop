<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // Услуга, к которой оставлен отзыв
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            // Пользователь, который оставил отзыв
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Оценка от 1 до 5
            $table->unsignedTinyInteger('rating'); 
            // Текст отзыва (может быть пустым, если поставили только оценку)
            $table->text('text')->nullable(); 
            
            // Флаг модерации (по умолчанию отзыв скрыт, админ должен одобрить)
            $table->boolean('is_approved')->default(false); 
            
            $table->timestamps();
            
            // Один пользователь может оставить только один отзыв на одну услугу
            $table->unique(['service_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};