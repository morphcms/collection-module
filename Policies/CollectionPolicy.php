<?php

namespace Modules\Collection\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Collection\Enums\CollectionPermission;
use Modules\Collection\Models\Collection;

class CollectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return ! $user || $user->can(CollectionPermission::ViewAny->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Collection $collection): bool
    {
        return ! $user || $user->can(CollectionPermission::View->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(CollectionPermission::Create->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Collection $collection): bool
    {
        return $user->can(CollectionPermission::Update->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Collection $collection): bool
    {
        return $user->can(CollectionPermission::Delete->value);
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Collection $collection): bool
    {
        return $user->can(CollectionPermission::Replicate->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Collection $collection): bool
    {
        return $user->can(CollectionPermission::Restore->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Collection $collection): bool
    {
        return $user->can(CollectionPermission::Delete->value);
    }
}
