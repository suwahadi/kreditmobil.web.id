<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'is_active',
        'meta_seo',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'meta_seo' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
