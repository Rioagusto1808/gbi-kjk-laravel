<?php

namespace App\Policies;

use App\Models\User;
use App\Models\KeuanganTransaksi;

class KeuanganPolicy
{
    public function view(User $user, KeuanganTransaksi $trx): bool
    {
        return $user->can('view keuangan');
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['superadmin', 'admin', 'staff']);
    }

    public function update(User $user, KeuanganTransaksi $trx): bool
    {
        return $user->hasRole(['superadmin', 'admin']);
    }

    public function delete(User $user, KeuanganTransaksi $trx): bool
    {
        return $user->hasRole('superadmin');
    }
}

