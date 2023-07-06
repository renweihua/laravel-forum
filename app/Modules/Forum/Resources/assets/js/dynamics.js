
// 展示回复评论框
showReply = function(_that) {
    // 关闭所有回复框
    $('ul.list-unstyled div.reply-box').hide();
    // 展示当前回复框
    $(_that).parent().next().find('div.reply-box').show();
}


/**
 * API定义
 */


// 动态点赞
dynamicPraise = function (dynamic_id) {
    return instance.post('/dynamics/praise', {
        dynamic_id
    });
}

// 动态收藏
dynamicCollection = function (dynamic_id) {
    return instance.post('/dynamics/collection', {
        dynamic_id
    });
}
