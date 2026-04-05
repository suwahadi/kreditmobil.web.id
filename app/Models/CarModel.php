<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'main_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function carTypes(): HasMany
    {
        return $this->hasMany(CarType::class);
    }

    public function carColors(): HasMany
    {
        return $this->hasMany(CarColor::class);
    }

    public function activeCarTypes(): HasMany
    {
        return $this->hasMany(CarType::class)->where('is_active', true);
    }

    public function getMinPriceAttribute(): int
    {
        return $this->activeCarTypes()->min('price_otr') ?? 0;
    }

    public function getMaxPriceAttribute(): int
    {
        return $this->activeCarTypes()->max('price_otr') ?? 0;
    }

    public function getPriceRangeAttribute(): string
    {
        $min = $this->min_price;
        $max = $this->max_price;
        
        if ($min === $max) {
            return 'Rp ' . number_format($min, 0, ',', '.');
        }
        
        return 'Rp ' . number_format($min, 0, ',', '.') . ' - Rp ' . number_format($max, 0, ',', '.');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
