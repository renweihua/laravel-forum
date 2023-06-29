<?php

namespace App\Modules\Comment\Policies;

use App\Modules\Comment\Entities\DynamicComment;
use App\Modules\Forum\Entities\Dynamic;
use App\Modules\User\Entities\UserAuth;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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

    public function update(UserAuth $currentUser, DynamicComment $dynamicComment)
    {
        return $currentUser->isAuthorOf($dynamicComment);
    }

    public function destroy(UserAuth $currentUser, DynamicComment $dynamicComment)
    {
        return $currentUser->isAuthorOf($dynamicComment) || $currentUser->isAuthorOf($dynamicComment->dynamic);
    }
}
