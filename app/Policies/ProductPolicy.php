<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create post');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $post): bool
    {
        return $user->can('edit post');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $post): bool
    {
        return $user->hasRole('admin');
    }


    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $post): bool
    {
        return false;
    }
}
