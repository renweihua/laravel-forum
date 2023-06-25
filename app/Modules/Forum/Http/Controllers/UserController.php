<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\User\Entities\User;
use App\Modules\Forum\Entities\Dynamic;

class UserController extends ForumController
{
    public function users()
    {
        $users = User::paginate(15);
        return view('forum::user', compact('users'));
    }
}
