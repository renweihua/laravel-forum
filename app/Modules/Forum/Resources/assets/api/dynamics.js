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

// 订阅动态
dynamicSubscribe = function (dynamic_id) {
    return instance.post('/dynamics/subscribe', {
        dynamic_id
    });
}


