<?php

namespace App\Policies;

use App\Models\User;
use App\Models\category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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
       return  $this->getUserAccess('can-view');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, category $category)
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
     * @param  \App\Models\category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, category $category)
    {
        return $this->getUserAccess('can-edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, category $category)
    {
        return $this->getUserAccess('can-delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, category $category)
    {
        //
    }

    public function getUserAccess($permission)
    {
       return isset(auth()->user()->role->permission->permissions['categories'][$permission]);
    }
}
