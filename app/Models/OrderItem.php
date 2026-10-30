<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'service_id', 'material_id', 
        'quantity', 'fixed_price', 'material_price'
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'fixed_price' => 'decimal:2',
        'material_price' => 'decimal:2',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}