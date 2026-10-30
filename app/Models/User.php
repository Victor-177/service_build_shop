<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Поля, доступные для массового заполнения.
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];

    /**
     * Поля, скрытые при сериализации.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Приведение типов.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Связь: у пользователя много заказов
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // Связь: у пользователя много элементов в корзине
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    // Связь: у пользователя много отзывов
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}