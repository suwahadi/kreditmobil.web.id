<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Leasing;

class LeasingPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function view(User $user, Leasing $model): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function create(User $user): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function update(User $user, Leasing $model): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function delete(User $user, Leasing $model): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }
}
