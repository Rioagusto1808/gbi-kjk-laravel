<?php

namespace App\Policies;

use App\Models\Jemaat;
use App\Models\User;

class JemaatPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['superadmin', 'admin', 'staff']);
    }

    public function view(User $user, Jemaat $jemaat): bool
    {
        return $user->hasRole(['superadmin', 'admin', 'staff'])
            || $user->jemaat_id === $jemaat->id;
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['superadmin', 'admin']);
    }

    public function update(User $user, Jemaat $jemaat): bool
    {
        return $user->hasRole(['superadmin', 'admin'])
            || $user->jemaat_id === $jemaat->id;
    }

    public function delete(User $user, Jemaat $jemaat): bool
    {
        return $user->hasRole('superadmin');
    }
}
