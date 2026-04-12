<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'New';
    public const STATUS_ASSIGNED = 'Assigned';
    public const STATUS_FOLLOW_UP = 'Follow_Up';
    public const STATUS_NEGOTIATION = 'Negotiation';
    public const STATUS_WON = 'Won';
    public const STATUS_LOST = 'Lost';

    protected $fillable = [
        'lead_code',
        'car_type_id',
        'customer_name',
        'phone',
        'source',
        'channel',
        'status',
        'notes',
        'sales_id',
        'submitted_at',
        'otp_id',
        'meta',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'meta' => 'array',
    ];

    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }

    public function sales()
    {
        return $this->belongsTo(User::class, 'sales_id');
    }

    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopePhoneExists($query, string $phone): bool
    {
        $digits = preg_replace('/\D/', '', $phone);
        $digits = ltrim($digits, '0');
        if (!str_starts_with($digits, '62')) {
            $digits = '62' . $digits;
        }

        return $query->where('phone', $digits)->exists();
    }

    public function getMaskedPhoneAttribute(): string
    {
        $digits = preg_replace('/\D/', '', (string) $this->phone);
        if (strlen($digits) <= 6) return '******';
        return substr($digits, 0, 4) . str_repeat('•', max(0, strlen($digits) - 6)) . substr($digits, -2);
    }
}
