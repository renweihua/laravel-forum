@extends('forum::layouts.app')
@section('title', '话题列表')

@section('content')
    <div class="container row">
        @if($topics)
            @foreach($topics as $topic)
                <div class="col-lg-4 col-md-3 col-sm-2 col-xs-2 mb-3">
                    <div class="card" id="topic-{{ $topic->topic_id }}">
                        <div class="card-header">
                            <a href="{{ route('topic.show', [$topic->topic_id]) }}">
                                @if($topic->is_default)
                                    <i class="fa fa-free-code-camp"></i>
                                @endif
                                {{ $topic->topic_name }}
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <p>动态量：{{ $topic->dynamic_count }}</p>
                                <p id="follow_count">关注量：<span>{{ $topic->follow_count }}</span></p>
                            </h5>
                            <p class="card-text">{!! $topic->topic_description !!}</p>
                            <a @click="topicFollow({{$topic}})" href="javascript:;" class="btn" aria-label="Left Align" style="border-radius: 0.28571429rem;box-shadow: inset 0 0 0 1px rgba(34,36,38,.15);    top: 5px;
    position: absolute;
    z-index: 1;
    right: 20px;
    background-color: #b7e3d399;">
                                @if($topic->isFollow)
                                    <div>
                                        <i class="fa fa-check mr-2"></i>
                                        已订阅
                                    </div>
                                @else
                                    <div>
                                        <i class="fa fa-plus mr-2"></i>
                                        订阅 TA
                                    </div>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection

@section('script')
    <script>
        const app = new window.vue({
                el: '#app', //element
                data: {
                    topics: @json($topics),
                },
                // 重定义解析变量，避免与PHP语法冲突
                delimiters: ['${', '}'],
                // 在 `methods` 对象中定义方法
                methods: {
                    // 关注话题
                    async topicFollow (topic) {
                        if(!topic) return;
                        await followTopic(topic.topic_id).then(res => {
                            Element.Message.success(res.msg);
                            // 同步渲染是否点赞标识
                            topic.is_follow = res.is_follow;
                            var topic_element = $('#topic-' + topic.topic_id);
                            var follow_count = parseInt(topic_element.find('#follow_count').html());
                            if(res.is_follow){
                                ++follow_count;
                                topic_element.find('i').removeClass('fa-plus');
                                topic_element.find('i').addClass('fa-check');
                            }else{
                                --follow_count;
                                topic_element.find('i').removeClass('fa-check');
                                topic_element.find('i').addClass('fa-plus');
                            }
                            topic_element.find('#follow_count').html(follow_count)
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

