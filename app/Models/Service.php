<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'short_description', 
        'description', 'fixed_price', 'duration', 'attributes', 
        'is_active', 'rating_avg', 'reviews_count'
    ];

    // Приводим JSON-поле к массиву и числа к нужному типу
    protected $casts = [
        'attributes' => 'array',
        'is_active' => 'boolean',
        'fixed_price' => 'decimal:2',
    ];

    // Связь: услуга принадлежит категории
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Связь: у услуги много изображений
    public function images(): HasMany
    {
        return $this->hasMany(ServiceImage::class);
    }

    // Связь: у услуги много материалов (многие ко многим)
    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'service_materials');
    }

    // Связь: у услуги много отзывов
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}