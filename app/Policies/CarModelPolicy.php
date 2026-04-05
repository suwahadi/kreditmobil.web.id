<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CarModel;

class CarModelPolicy
{
    public function before(User $user, string $ability)
    {
        if ($user->role === 'admin') {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin','manager','sales'], true);
    }

    public function view(User $user, CarModel $model): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, CarModel $model): bool
    {
        return false;
    }

    public function delete(User $user, CarModel $model): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }
}
