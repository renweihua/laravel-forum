<?php

namespace App\Constants;

// 会员权限
class UserAuthority
{
    const BASE = [
        // 发布动态
        'dynamic.push' => '发布动态',
        // 编辑动态
        'dynamic.update' => '编辑动态',
        // 点赞动态
        'dynamic.praise' => '动态·点赞',
        // 评论动态
        'dynamic.comment' => '动态·评论',
        // 举报评论
        'dynamic.comment.report' => '动态·举报评论',
        // 收藏动态
        'dynamic.collection' => '动态·收藏',
        // 删除动态
        'dynamic.delete' => '动态·删除',
        // 动态锁定
        'dynamic.lock' => '动态·锁定',
        // 动态举报
        'dynamic.report' => '动态·举报',
    ];
}
