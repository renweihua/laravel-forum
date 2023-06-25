<?php

namespace App\Modules\Forum\Http\Controllers;

use App\Modules\Forum\Entities\Dynamic;

class DynamicController extends ForumController
{
    public function show($id)
    {
        $dynamic = Dynamic::with(['user', 'userInfo'])->find($id);
        // 会员的空间数量
        $dynamic->user->dynamic_count = Dynamic::getDynamicsTotalByUser($dynamic->user_id);
        return view('forum::detail', compact('dynamic'));
    }
}
