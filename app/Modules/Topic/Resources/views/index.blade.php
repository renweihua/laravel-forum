@extends('forum::layouts.app')
@section('title', isset($topic) ? $topic->topic_name : '话题列表')

@section('content')
    @include('forum::dynamic._dynamics_home')
@endsection

@section('script')
    <script>
        const app = new window.vue({
                el: '#app', //element
                data: {
                    topic: @json($topic),
                },
                // 重定义解析变量，避免与PHP语法冲突
                delimiters: ['${', '}'],
                // 在 `methods` 对象中定义方法
                methods: {
                    // 关注话题
                    async topicFollow () {
                        await followTopic(this.topic.topic_id).then(res => {
                            Element.Message.success(res.msg);
                            // 同步渲染是否点赞标识
                            this.topic.is_follow = res.is_follow;
                        });
                    },
                    async praise(){

                    },
                    async collection(){

                    },
                }
            } // json格式的对象，使用大括号包裹，里面放了键值对，在js中键可以没有引号，多个键值对之间使用，分隔
        );
    </script>
@endsection
