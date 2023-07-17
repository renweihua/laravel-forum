@extends('forum::layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')

    <div class="row">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            <div class="card ">
                <img class="card-img-top"
                     src="{{ $user->userInfo->user_avatar }}"
                     alt="{{ $user->userInfo->nick_name }}" />
                <div class="card-body">
                    <h5><strong>最近活跃</strong></h5>
                    <p title="{{ $user->userInfo->last_actived_at }}">{{ $user->userInfo->last_actived_at }}</p>
                    <hr>
                    <h5><strong>个人简介</strong></h5>
                    <p>{{ $user->userInfo->basic_extends['user_introduction'] }}</p>
                    <hr>
                    @if($user->userInfo->basic_extends['location'])
                    <h5><strong>所在城市</strong></h5>
                    <p>{{ $user->userInfo->basic_extends['location'] }}</p>
                    <hr>
                    @endif
                    <h5><strong>注册于</strong></h5>
                    <p>{{ $user->userInfo->time_formatting }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="card ">
                <div class="card-body">
                    <h1 class="mb-0" style="font-size:22px;">
                        {{ $user->userInfo->nick_name }}
                        @if($user->userInfo->user_sex == 0)
                            <small><i class="fa fa-mars"></i></small>
                        @elseif($user->userInfo->user_sex == 1)
                            <small><i class="fa fa-venus"></i></small>
                        @endif
                    </h1>

                    <a @click="follow" href="javascript:;" class="btn" aria-label="Left Align" style="border-radius: 0.28571429rem;box-shadow: inset 0 0 0 1px rgba(34,36,38,.15);top: 15px;position: absolute;right: 15px;">
                        <div v-if="!user.user_info.is_follow" >
                            <i class="fa fa-plus mr-2"></i>
                            关注 TA
                        </div>
                        <div v-else>
                            <i class="fa fa-check mr-2"></i>
                            已关注
                        </div>
                    </a>
                </div>
            </div>
            <hr>

            {{-- 用户发布的内容 --}}
            <div class="card ">
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link bg-transparent {{ active_class(if_query('tab', null)) }}" href="{{ route('users.show', $user->user_id) }}">
                                Ta 的文章
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bg-transparent {{ active_class(if_query('tab', 'replies')) }}" href="{{ route('users.show', [$user->user_id, 'tab' => 'replies']) }}">
                                Ta 的回复
                            </a>
                        </li>
                    </ul>
                    @if (if_query('tab', 'replies'))
                        @include('user::users._comments', ['comments' => $comments])
                    @else
                        @include('user::users._dynamics', ['topics' => $dynamics])
                    @endif
                </div>
            </div>

        </div>
    </div>
@stop

@section('script')
    <script>
        const app = new window.vue({
                el: '#app', //element
                data: {
                    user: @json($user),
                },
                // 重定义解析变量，避免与PHP语法冲突
                delimiters: ['${', '}'],
                // 在 `methods` 对象中定义方法
                methods: {
                    // 关注会员
                    async follow () {
                        await followUser(this.user.user_id).then(res => {
                            Element.Message.success(res.msg);
                            // 同步渲染是否点赞标识
                            this.user.user_info.is_follow = res.is_follow;
                        });
                    },
                }
            } // json格式的对象，使用大括号包裹，里面放了键值对，在js中键可以没有引号，多个键值对之间使用，分隔
        );
    </script>
@endsection
