@section('script')
    <script>
        const app = new window.vue({
                el: '#app', //element
                data: {
                    dynamics: @json($dynamics),
                    topic: @json($topic ?? []),
                    login_user: @json($login_user ?? []),
                },
                // 重定义解析变量，避免与PHP语法冲突
                delimiters: ['${', '}'],
                // 在 `methods` 对象中定义方法
                methods: {
                    // 签到/打卡
                    async loginUserSign(){
                        if(!this.login_user) return;
                        await userSign().then(res => {
                            Element.Message.success(res.msg);
                            // 同步渲染是否点赞标识
                            this.login_user.user_info.is_sign = res.is_sign;
                        });
                    },
                    // 关注话题
                    async topicFollow () {
                        if(!this.topic) return;
                        await followTopic(this.topic.topic_id).then(res => {
                            Element.Message.success(res.msg);
                            // 同步渲染是否点赞标识
                            this.topic.is_follow = res.is_follow;
                        });
                    },
                    // 动态列表不考虑使用vue渲染，路由链接等皆需要模型对象支持
                    async praise(dynamic_id){
                        await dynamicPraise(dynamic_id).then(res => {
                            Element.Message.success(res.msg);
                            // 同步渲染是否点赞标识
                            var count = parseInt($('#dynamic-' + dynamic_id).find('#praise>span').html());
                            if(res.is_praise){
                                ++count;
                                $('#dynamic-' + dynamic_id).find('#praise').find('i').removeClass('fa-thumbs-o-up');
                                $('#dynamic-' + dynamic_id).find('#praise').find('i').addClass('fa-thumbs-up');
                            }else{
                                --count;
                                $('#dynamic-' + dynamic_id).find('#praise').find('i').removeClass('fa-thumbs-up');
                                $('#dynamic-' + dynamic_id).find('#praise').find('i').addClass('fa-thumbs-o-up');
                            }
                            $('#dynamic-' + dynamic_id).find('#praise>span').html(count)
                        });
                    },
                    async collection(dynamic_id){
                        await dynamicCollection(dynamic_id).then(res => {
                            Element.Message.success(res.msg);
                            // 同步渲染是否收藏标识
                            var count = parseInt($('#dynamic-' + dynamic_id).find('#collection>span').html());
                            if(res.is_collection){
                                ++count;
                                $('#dynamic-' + dynamic_id).find('#collection').find('i').removeClass('fa-heart-o');
                                $('#dynamic-' + dynamic_id).find('#collection').find('i').addClass('fa-heartbeat');
                            }else{
                                --count;
                                $('#dynamic-' + dynamic_id).find('#collection').find('i').removeClass('fa-heartbeat');
                                $('#dynamic-' + dynamic_id).find('#collection').find('i').addClass('fa-heart-o');
                            }
                            $('#dynamic-' + dynamic_id).find('#collection>span').html(count)
                        });
                    },
                }
            } // json格式的对象，使用大括号包裹，里面放了键值对，在js中键可以没有引号，多个键值对之间使用，分隔
        );
        // 可追加变量
        // app.$data.home = '测试追加变量';
        // 不可外部定义方法，页面调用！
    </script>
@endsection
