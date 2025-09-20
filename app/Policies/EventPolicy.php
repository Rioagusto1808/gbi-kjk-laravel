<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Event;

class EventPolicy
{
    public function view(User $user, Event $event): bool
    {
        return $user->can('view event');
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['superadmin', 'admin', 'staff']);
    }

    public function update(User $user, Event $event): bool
    {
        return $user->hasRole(['superadmin', 'admin']);
    }

    public function delete(User $user, Event $event): bool
    {
        return $user->hasRole('superadmin');
    }

    public function register(User $user, Event $event): bool
    {
        return $user->hasRole(['jemaat', 'staff']);
    }
}
