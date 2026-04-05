<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\User;

class LeadPolicy
{
    public function viewAny(?User $user): bool
    {
        return (bool) $user;
    }

    public function view(?User $user, Lead $lead): bool
    {
        return (bool) $user;
    }

    public function create(?User $user): bool
    {
        return false;
    }

    public function update(?User $user, Lead $lead): bool
    {
        if (! $user) return false;
        if ($user->role === 'admin') return true;
        if ($user->role === 'manager') return true;
        if ($user->role === 'sales') return (int) $lead->sales_id === (int) $user->id;
        return false;
    }

    public function delete(?User $user, Lead $lead): bool
    {
        if (! $user) return false;
        if ($user->role === 'admin') return true;
        return false;
    }

    public function restore(?User $user, Lead $lead): bool
    {
        return false;
    }

    public function forceDelete(?User $user, Lead $lead): bool
    {
        return false;
    }
}
