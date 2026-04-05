<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarType extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_model_id',
        'name',
        'slug',
        'transmission',
        'price_otr',
        'specifications',
        'is_active',
    ];

    protected $casts = [
        'price_otr' => 'integer',
        'specifications' => 'array',
        'is_active' => 'boolean',
    ];

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price_otr, 0, ',', '.');
    }

    public function getEngineSpecificationAttribute(): ?array
    {
        return $this->specifications['engine'] ?? null;
    }

    public function getDimensionsSpecificationAttribute(): ?array
    {
        return $this->specifications['dimensions'] ?? null;
    }

    public function getFeaturesSpecificationAttribute(): ?array
    {
        return $this->specifications['features'] ?? null;
    }

    public function getCapacitySpecificationAttribute(): ?array
    {
        return $this->specifications['capacity'] ?? null;
    }

    public function getTransmissionLabelAttribute(): string
    {
        return match($this->transmission) {
            'MT' => 'Manual',
            'AT' => 'Otomatis',
            'CVT' => 'CVT',
            default => $this->transmission,
        };
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
