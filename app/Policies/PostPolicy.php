<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Helper function to check if a user is the blog owner.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    private function isOwner(User $user)
    {
        // Set the owner's email address here
        return $user->email === 'rafiimanullah@gmail.com';
    }

    /**
     * Determine whether the user can create models.
     * Only the owner can create new posts.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $this->isOwner($user);
    }

    /**
     * Determine whether the user can update the model.
     * Only the owner can update any post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        return $this->isOwner($user);
    }

    /**
     * Determine whether the user can delete the model.
     * Only the owner can delete any post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return bool
     */
    public function delete(User $user, Post $post)
    {
        return $this->isOwner($user);
    }
}
