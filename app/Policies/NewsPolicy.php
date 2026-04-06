<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;

class NewsPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    public function view(User $user, News $news): bool
    {
        return $user->role === 'admin';
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    public function update(User $user, News $news): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    public function delete(User $user, News $news): bool
    {
        return $user->role === 'admin';
    }
}
