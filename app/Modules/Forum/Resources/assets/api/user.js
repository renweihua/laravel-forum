// 关注会员
followUser = function (user_id) {
    return instance.post('/user/follow', {
        user_id
    });
}
