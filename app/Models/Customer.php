<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'nik',
        'name',
        'gender',
        'phone',
        'email',
        'address',
        'city',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
