<?php

namespace App\Observers;

use App\Models\User;
use Spatie\Activitylog\Facades\Activity;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log('User created');
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->withProperties(['attributes' => $user->getChanges()])
            ->log('User updated');
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log('User deleted');
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log('User restored');
    }

    /**
     * Handle the User "forceDeleted" event.
     */
    public function forceDeleted(User $user)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log('User permanently deleted');
    }
}
