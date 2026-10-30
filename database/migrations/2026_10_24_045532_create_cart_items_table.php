<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            // Пользователь, который добавил услугу
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Услуга
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            // Материал (может быть не выбран, поэтому nullable)
            $table->foreignId('material_id')->nullable()->constrained()->nullOnDelete();
            
            // Объем работ (может быть дробным, например 2.5 м2)
            $table->decimal('quantity', 10, 2)->default(1); 
            
            $table->timestamps();
            
            // Один пользователь не может добавить одну и ту же услугу с одним и тем же материалом дважды
            $table->unique(['user_id', 'service_id', 'material_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};