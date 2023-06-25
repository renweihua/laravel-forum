<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;

class DynamicController extends ForumController
{
    public function show($id)
    {
        $dynamic = Dynamic::with(['user', 'userInfo'])->find($id);
        return view('forum::detail', compact('dynamic'));
    }
}
