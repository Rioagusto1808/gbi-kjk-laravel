<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Berita;

class BeritaPolicy
{
    public function view(User $user, Berita $berita): bool
    {
        return $user->can('view berita');
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['superadmin', 'admin', 'staff']);
    }

    public function update(User $user, Berita $berita): bool
    {
        return $user->hasRole(['superadmin', 'admin']);
    }

    public function delete(User $user, Berita $berita): bool
    {
        return $user->hasRole('superadmin');
    }
}
