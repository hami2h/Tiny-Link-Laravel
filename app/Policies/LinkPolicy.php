<?php

namespace App\Policies;

use App\Models\Link;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinkPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return ($user->type == 'user');
    }

    public function edit(User $user, Link $link)
    {
        return  $user->id === $link->user_id;
    }

    public function changeState(User $user, Link $link)
    {
        return ($user->type == 'manager');
    }

    public function remove(User $user, Link $link)
    {
        return  $user->id === $link->user_id;
    }
}
