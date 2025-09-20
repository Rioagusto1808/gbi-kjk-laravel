<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ibadah;

class IbadahPolicy
{
    public function view(User $user, Ibadah $ibadah): bool
    {
        return $user->can('view ibadah');
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['superadmin', 'admin']);
    }

    public function update(User $user, Ibadah $ibadah): bool
    {
        return $user->hasRole(['superadmin', 'admin']);
    }

    public function delete(User $user, Ibadah $ibadah): bool
    {
        return $user->hasRole('superadmin');
    }

    public function absen(User $user, Ibadah $ibadah): bool
    {
        return $user->hasRole(['superadmin', 'admin', 'staff']);
    }
}
