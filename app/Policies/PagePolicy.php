<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;


class PagePolicy
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
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Page $page)
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
     * @param  \App\Models\Page  $page
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Page $page)
    {   
                       
     
        return $this->getUserAccess('can-edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Page $page)
    {   
        //move to trash action

        return $this->getUserAccess('can-delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Page $page)
    {
        return $this->getUserAccess('can-delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Page $page)
    {
        return $this->getUserAccess('can-delete');
    }


    public function publish(User $user,Page $page)
    {   
        if( $this->getUserAccess('can-publish') && $this->getUserAccess('can-list') && ( !$this->getUserAccess('can-view') ) )
        {
            return $page->user_id == $user->id;
        }
        return $this->getUserAccess('can-publish') && $this->getUserAccess('can-view');
    }

    public function remove(User $user)
    {
       return $this->getUserAccess('can-delete');  
    }

    public function getUserAccess($permission)
    {
       return isset(auth()->user()->role->permission->permissions['pages'][$permission]);
    }

    


}
