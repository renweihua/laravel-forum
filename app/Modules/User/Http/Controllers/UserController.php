<?php

namespace App\Modules\User\Http\Controllers;

use App\Modules\User\Entities\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function users()
    {
        $users = User::with('userInfo')->paginate(4);
        return view('user::users', compact('users'));
    }
}
