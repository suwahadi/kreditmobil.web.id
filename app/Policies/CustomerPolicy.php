<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;

class CustomerPolicy
{
    public function viewAny(?User $user): bool
    {
        return (bool) $user;
    }

    public function view(?User $user, Customer $customer): bool
    {
        return (bool) $user;
    }

    public function create(?User $user): bool
    {
        return false;
    }

    public function update(?User $user, Customer $customer): bool
    {
        if (! $user) return false;
        if ($user->role === 'admin') return true;
        if ($user->role === 'manager') return true;
        if ($user->role === 'sales') return false;
        return false;
    }

    public function delete(?User $user, Customer $customer): bool
    {
        if (! $user) return false;
        if ($user->role === 'admin') return true;
        return false;
    }

    public function restore(?User $user, Customer $customer): bool
    {
        return false;
    }

    public function forceDelete(?User $user, Customer $customer): bool
    {
        return false;
    }
}
