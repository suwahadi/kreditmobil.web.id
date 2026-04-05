<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenor_months',
        'interest_rate',
    ];

    protected $casts = [
        'interest_rate' => 'decimal:4',
    ];

    public function getFormattedInterestRateAttribute(): string
    {
        return ($this->interest_rate * 100) . '%';
    }

    public function calculateMonthlyPayment(int $principalAmount): int
    {
        $monthlyRate = $this->interest_rate / 12;
        $numPayments = $this->tenor_months;
        
        if ($monthlyRate == 0) {
            return intval($principalAmount / $numPayments);
        }
        
        $monthlyPayment = $principalAmount * 
            ($monthlyRate * pow(1 + $monthlyRate, $numPayments)) / 
            (pow(1 + $monthlyRate, $numPayments) - 1);
        
        return intval($monthlyPayment);
    }
}
