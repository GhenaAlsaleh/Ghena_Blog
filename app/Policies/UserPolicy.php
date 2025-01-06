<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function manageUser(User $user):bool{
        return $user->is_admin;
    }

    /*public function viewAny(User $user): bool
    {
        //
    }

    
    public function view(User $user, User $model): bool
    {
        //
    }

    
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

   
    public function update(User $user, User $model): bool
    {
        //
    }

    public function delete(User $user, User $model): bool
    {
        //
    }

    public function restore(User $user, User $model): bool
    {
        //
    }

    public function forceDelete(User $user, User $model): bool
    {
        //
    }
        */
}
