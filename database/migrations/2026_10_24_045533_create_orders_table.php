<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Клиент, оформивший заказ
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Исполнитель (бригада). Изначально null, назначается админом позже
            $table->foreignId('executor_id')->nullable()->constrained()->nullOnDelete();
            
            // Статус заказа
            $table->enum('status', ['new', 'processing', 'completed', 'cancelled'])->default('new');
            
            // Итоговая сумма
            $table->decimal('total', 10, 2); 
            
            // Данные для связи и выполнения
            $table->string('address'); // Адрес объекта
            $table->string('phone'); // Телефон для связи
            $table->date('preferred_date')->nullable(); // Желаемая дата начала работ
            $table->text('comment')->nullable(); // Пожелания клиента
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};