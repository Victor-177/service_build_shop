<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceImage extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'path', 'is_main'];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    // Связь: изображение принадлежит услуге
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}