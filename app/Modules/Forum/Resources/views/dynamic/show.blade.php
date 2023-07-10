@extends('forum::layouts.app')

@section('title', $dynamic->dynamic_title)
@section('description', make_excerpt($dynamic->dynamic_content))

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center mt-3 mb-3">
                        {{ $dynamic->dynamic_title }}
                    </h1>

                    <div class="text-center">
                        <a @click="subscribeDynamic" href="javascript:;" class="btn" aria-label="Left Align" style="border-radius: 0.28571429rem;box-shadow: inset 0 0 0 1px rgba(34,36,38,.15);">
                            <div v-if="!dynamic.is_subscribe" >
                                <i class="fa fa-plus mr-2"></i>
                                订阅
                            </div>
                            <div v-else>
                                <i class="fa fa-check mr-2"></i>
                                已订阅
                            </div>
                        </a>
                    </div>

                    <div class="article-meta text-center text-secondary">
                        {{ $dynamic->time_formatting }}
                        ⋅
                        <small>
                            <i class="fa fa-eye"></i>
                            {{ $dynamic->cache_extends['reads_num'] }}
                        </small>
                        ⋅
                        <small class="cursor-pointer" @click="praise">
                            <i class="fa" :class="[dynamic.is_praise ? 'fa-thumbs-up' : 'fa-thumbs-o-up']"></i>
                            ${ dynamic.cache_extends.praises_count }
                        </small>
                        ⋅
                        <small class="cursor-pointer" @click="collection">
                            <i class="fa" :class="[dynamic.is_collection ? 'fa-heartbeat' : 'fa-heart-o']"></i>
                            ${ dynamic.cache_extends.collections_count }
                        </small>
                        ⋅
                        <small>
                            <i class="fa fa-commenting-o"></i>
                            <span>{{ $dynamic->cache_extends['comments_count'] }}</span>
                        </small>
                    </div>

                    <div class="topic-body mt-4">
                        {!! $dynamic->dynamic_content !!}
                    </div>

                    @can('update', $dynamic)
                        <div class="operate">
                            <hr>
                            <a href="{{ route('dynamics.edit', $dynamic->dynamic_id) }}" class="btn btn-outline-secondary btn-sm" role="button">
                                <i class="fa fa-edit"></i> 编辑
                            </a>
                            <form action="{{ route('dynamics.destroy', $dynamic->dynamic_id) }}" method="post"
                                  style="display: inline-block;"
                                  onsubmit="return confirm('您确定要删除吗？');">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-outline-secondary btn-sm">
                                    <i class="fa fa-trash"></i> 删除
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>

            {{-- 用户回复列表 --}}
            <div class="card topic-reply mt-4">
                <div class="card-body">
                    @includeIf('comment::dynamic._comment_box', ['dynamic' => $dynamic, 'reply_id' => 0])
                    @includeIf('comment::dynamic._reply_list', [
                        'dynamic' => $dynamic,
                        'comments' => $dynamic->topComments
                    ])
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        作者：{{ $dynamic->userInfo->nick_name }}
                    </div>
                    <hr>
                    <div class="text-center">
                        <a @click="follow" href="javascript:;" class="btn" aria-label="Left Align" style="border-radius: 0.28571429rem;box-shadow: inset 0 0 0 1px rgba(34,36,38,.15);">
                            <div v-if="!dynamic.user_info.is_follow" >
                                <i class="fa fa-plus mr-2"></i>
                                关注 TA
                            </div>
                            <div v-else>
                                <i class="fa fa-check mr-2"></i>
                                已关注
                            </div>
                        </a>
                    </div>
                    <hr>
                    <div class="media">
                        <div align="center">
                            <a href="{{ route('users.show', $dynamic->user_id) }}">
                                <img class="thumbnail img-fluid" src="{{ $dynamic->userInfo->user_avatar }}" width="300px" height="300px">
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row author-statistics">
                        <div class="col-3">
                            <div>文章</div>
                            <div>{{ $dynamic->user->dynamic_count }}</div>
                        </div>
                        <div class="col-3">
                            <div>粉丝</div>
                            <div>{{ $dynamic->user->fan_count }}</div>
                        </div>
                        <div class="col-3">
                            <div>喜欢</div>
                            <div>{{ $dynamic->user->praise_dynamic_count }}</div>
                        </div>
                        <div class="col-3">
                            <div>收藏</div>
                            <div>{{ $dynamic->user->collection_dynamic_count }}</div>
                        </div>
                    </div>
                </div>
            </div>


            @include('forum::layouts._active_users')

            @include('forum::layouts._friendlinks')
        </div>
    </div>
@endsection

@section('script')
    @includeIf('comment::dynamic._reply_praise')
    <script>
        const app = new window.vue({
                el: '#app', //element
                data: {
                    dynamic: @json($dynamic),
                },
                // 重定义解析变量，避免与PHP语法冲突
                delimiters: ['${', '}'],
                // 在 `methods` 对象中定义方法
                methods: {
                    // 动态点赞
                    async praise () {
                        await dynamicPraise(this.dynamic.dynamic_id).then(res => {
                            Element.Message.success(res.msg);
                            // 同步渲染是否点赞标识
                            this.dynamic.is_praise = res.is_praise;
                            if(this.dynamic.is_praise){
                                ++this.dynamic.cache_extends.praises_count;
                            }else{
                                --this.dynamic.cache_extends.praises_count;
                            }
                        });
                    },
                    // 收藏动态
                    async collection () {
                        await dynamicCollection(this.dynamic.dynamic_id).then(res => {
                            Element.Message.success(res.msg);
                            // 同步渲染是否点赞标识
                            this.dynamic.is_collection = res.is_collection;
                            if(this.dynamic.is_collection){
                                ++this.dynamic.cache_extends.collections_count;
                            }else{
                                --this.dynamic.cache_extends.collections_count;
                            }
                        });
                    },
                    // 关注会员
                    async follow () {
                        await followUser(this.dynamic.user_id).then(res => {
                            Element.Message.success(res.msg);
                            // 同步渲染是否点赞标识
                            this.dynamic.user_info.is_follow = res.is_follow;
                        });
                    },
                    // 订阅动态
                    async subscribeDynamic(){
                        await dynamicSubscribe(this.dynamic.dynamic_id).then(res => {
                            Element.Message.success(res.msg);
                            // 同步渲染是否点赞标识
                            this.dynamic.is_subscribe = res.is_subscribe;
                        });
                    }
                }
            } // json格式的对象，使用大括号包裹，里面放了键值对，在js中键可以没有引号，多个键值对之间使用，分隔
        );
    </script>
@endsection
