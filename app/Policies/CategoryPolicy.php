<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function view(User $user, Category $model): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function create(User $user): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function update(User $user, Category $model): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function delete(User $user, Category $model): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }
}
