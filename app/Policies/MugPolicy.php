<?php

namespace App\Policies;

use App\Models\Mug;
use App\Models\User;

/**
 * Policy for managing Mug-related authorization.
 */
class MugPolicy
{
    /**
     * Determine if the given user can update the mug.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mug   $mug
     * @return bool
     */
    public function update(User $user, Mug $mug)
    {
        return $user->id === $mug->user_id;
    }

    /**
     * Determine if the given user can delete the mug.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mug   $mug
     * @return bool
     */
    public function delete(User $user, Mug $mug)
    {
        return $user->id === $mug->user_id;
    }
}
