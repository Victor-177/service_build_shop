<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            // Привязка к заказу (при удалении заказа его позиции тоже удаляются)
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            
            // Сама услуга и материал (запрещаем удалять услугу, если она есть в заказах)
            $table->foreignId('service_id')->constrained()->restrictOnDelete();
            $table->foreignId('material_id')->nullable()->constrained()->nullOnDelete();
            
            // Объем работ (например, 15.5 м2)
            $table->decimal('quantity', 10, 2);
            
            // Фиксируем цены на момент покупки
            $table->decimal('fixed_price', 10, 2); 
            $table->decimal('material_price', 10, 2)->default(0); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};