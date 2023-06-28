<?php

namespace App\Modules\User\Policies;

use App\Modules\User\Entities\UserAuth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(UserAuth $currentUser, UserAuth $user)
    {
        return $currentUser->user_id === $user->user_id;
    }
}
