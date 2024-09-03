<?php

namespace App\Policies;

use Illuminate\Notifications\DatabaseNotification;
use App\Models\User;
use Illuminate\Auth\Access\Response;



class NotificationPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DatabaseNotification $databaseNotification): bool
    {
        return $user->id === $databaseNotification->notifiable_id;
    }
}
