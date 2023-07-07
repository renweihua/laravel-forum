// 关注话题
followTopic = function (topic_id) {
    return instance.post('/topic/follow', {
        topic_id
    });
}
