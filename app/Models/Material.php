<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'unit', 'price_per_unit'];

    protected $casts = [
        'price_per_unit' => 'decimal:2',
    ];

    // Связь: материал может использоваться во многих услугах
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'service_materials');
    }
}