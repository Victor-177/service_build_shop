<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'user_id', 'rating', 'text', 'is_approved'];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    // Связь: отзыв принадлежит услуге
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // Связь: отзыв оставил пользователь
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}