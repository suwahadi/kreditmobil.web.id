<?php

namespace App\Policies;

use App\Models\Promo;
use App\Models\User;

class PromoPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    public function view(User $user, Promo $promo): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    public function update(User $user, Promo $promo): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    public function delete(User $user, Promo $promo): bool
    {
        return $user->role === 'admin';
    }
}
