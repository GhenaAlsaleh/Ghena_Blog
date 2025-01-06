<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    public function sameUsercomment(User $user, Comment $comment):bool{
        return $user->id == $comment->user_id;
    }
    public function sameUsercommentorpost(User $user, Comment $comment):bool{
        $post= Post::find($comment->post_id);
        return (($user->id == $comment->user_id)||($user->id == $post->user_id));
    }
    /*
    public function viewAny(User $user): bool
    {
        //
    }

    
    public function view(User $user, Comment $comment): bool
    {
        //
    }

    
    public function create(User $user): bool
    {
        //
    }

    
    public function update(User $user, Comment $comment): bool
    {
        //
    }

    
    public function delete(User $user, Comment $comment): bool
    {
        //
    }

   
    public function restore(User $user, Comment $comment): bool
    {
        //
    }

    
    public function forceDelete(User $user, Comment $comment): bool
    {
        //
    }
        */
}
