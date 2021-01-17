<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function editOrDelete(User $user, Post $post)
    {
        if ($user->admin != 1) {
            return $post->user()->is($user);
        } else {
            return true;
        }
    }
}

