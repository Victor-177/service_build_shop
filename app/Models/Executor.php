<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Executor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'phone', 'email', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Связь: бригада умеет работать с несколькими категориями
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    // Связь: заказы, которые назначены этой бригаде
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}