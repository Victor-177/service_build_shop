<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'service_id', 'material_id', 'quantity'];

    protected $casts = [
        'quantity' => 'decimal:2',
    ];

    // Связь: элемент корзины принадлежит пользователю
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Связь: элемент корзины содержит услугу
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // Связь: элемент корзины содержит материал (может быть null)
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}