<?php

namespace App\Modules\Forum\Policies;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\User\Entities\UserAuth;
use Illuminate\Auth\Access\HandlesAuthorization;

class DynamicPolicy
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

    public function update(UserAuth $currentUser, Dynamic $dynamic)
    {
        return $currentUser->user_id === $dynamic->user_id;
    }
}
