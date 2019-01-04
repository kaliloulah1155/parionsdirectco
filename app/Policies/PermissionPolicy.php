<?php
namespace App\Policies;

use App\User;
use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the perm.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Permission  $perm
     * @return mixed
     */
    public function view(User $user, Permission $perm)
    {
        return TRUE;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Permission  $perm
     * @return mixed
     */
    public function update(User $user, Permission  $perm)
    {
        return $user->id == $perm->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Permission  $perm
     * @return mixed
     */
    public function delete(User $user, Post $perm)
    {
        return $user->id == $perm->user_id;
    }
}
