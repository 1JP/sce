<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Deslink;
use App\Models\User;

class DeslinkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Deslink $deslink): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Deslink $deslink): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Deslink $deslink): bool
    {
        return $user->id == $deslink->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Deslink $deslink): bool
    {
        return $user->id == $deslink->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Deslink $deslink): bool
    {
        return $user->id == $deslink->user_id;
    }
}
