<?php

namespace App\Policies;

use App\Models\SystemLink;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemLinkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
       return $this->getUserAccess('can-view');

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SystemLink  $systemLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SystemLink $systemlink)
    {
        return $this->getUserAccess('can-view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
       return $this->getUserAccess('can-add');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SystemLink  $systemLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, SystemLink $systemlink)
    {
        return $this->getUserAccess('can-edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SystemLink  $systemLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SystemLink $systemlink)
    {
        return $this->getUserAccess('can-delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SystemLink  $systemLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SystemLink $systemlink)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SystemLink  $systemLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, SystemLink $systemlink)
    {
        //
    }

    public function getUserAccess($permission)
    {
       return isset(auth()->user()->role->permission->permissions['system_links'][$permission]);
    }
}
