<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'is_active',
        'meta_seo',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'meta_seo' => 'array',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        $path = $this->thumbnail ?? null;
        if (empty($path)) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $trimmed = ltrim($path, '/');
        return Storage::disk('public')->url($trimmed);
    }
}
