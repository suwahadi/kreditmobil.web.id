<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_model_id',
        'color_name',
        'hex_code',
        'image_path',
    ];

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function getColorStyleAttribute(): string
    {
        return "background-color: {$this->hex_code};";
    }
}
