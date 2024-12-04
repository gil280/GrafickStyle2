<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Extras;
use App\Models\Playeras;
use App\Models\Sudaderas;
use App\Models\Taza;
use App\Models\Termo;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function update(user $user,Extras $extras)
    {
        return $user->id === $extras->user_id;

    }
    public function delete(user $user,Extras $extras)
    {
        return $user->id === $extras->user_id;

    }
}
