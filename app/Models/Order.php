<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'executor_id', 'status', 'total', 
        'address', 'phone', 'preferred_date', 'comment'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'preferred_date' => 'date',
    ];

    // Связь: заказ оформлен клиентом
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Связь: заказ назначен на бригаду (может быть null)
    public function executor(): BelongsTo
    {
        return $this->belongsTo(Executor::class);
    }

    // Связь: в заказе много позиций (услуг)
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}