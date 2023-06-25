@extends('forum::layouts.master')

@section('page-header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        动态详情
                    </h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-9">
        <div class="row row-cards justify-content-center" id="topic-page">
            <div class="col-md-12" id="topic">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title text-reset" style="font-size: 1.2rem;line-height: 1.5;" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="{{ $dynamic->dynamic_title }}">
                            {{ $dynamic->dynamic_title }}
                                <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="帖子已锁定" style="display: inline-block" class="text-reset bg-transparent">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         style="--tblr-icon-size:1.5rem;margin-bottom: 4px"
                                         class="icon icon-tabler icon-tabler-lock" width="20" height="20"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>
                                        <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M8 11v-4a4 4 0 0 1 8 0v4"></path>
                                    </svg>
                                </span>
                                <span class="text-green">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-diamond"
                                         style="--tblr-icon-size:1.8rem" width="24" height="24" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                         stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M6 5h12l3 5l-8.5 9.5a.7 .7 0 0 1 -1 0l-8.5 -9.5l3 -5"></path>
                                       <path d="M10 12l-2 -2.2l.6 -1"></path>
                                    </svg>
                                </span>
                        </h2>
                        <div class="card-actions">
                                <div class="dropdown">
                                    <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end text-muted">
                                        <a class="dropdown-item" href="javascript:;">编辑</a>
                                        <a class="dropdown-item" href="javascript:;">删除</a>
                                        <a class="dropdown-item" href="javascript:;">置顶</a>
                                        <a class="dropdown-item" href="javascript:;">精华</a>
                                        <a class="dropdown-item" href="javascript:;">热门</a>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <!-- 作者信息 -->
                    <div class="mx-3 my-3 mb-0" id="author">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-auto">
                                        <a class="avatar avatar-rounded" href="/users/{{ $dynamic->user_id }}.html"
                                           style="background-image: url({{ $dynamic->userInfo->user_avatar }})"></a>
                                    </div>
                                    <div class="col">
                                        <div class="topic-author-name">
                                            {!! $dynamic->userInfo->nick_name !!}
                                        </div>
                                        <div>
                                            <span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $dynamic->time_formatting }}">
                                            发布于:{{ $dynamic->time_formatting }}
                                            </span>
                                            ｜
                                            <span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$dynamic->last_time_formatting}}">更新:{{ ($dynamic->last_time_formatting) }}</span>
                                            @if($dynamic->created_ip)
                                                <span>
                                                    |
                                                    <span class="text-red">
                                                        {{$dynamic->created_ip}}
                                                    </span>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-0 mb-0">
                        <div class="hr-text hr-text-right mt-3 mb-0" style="margin-right: 1rem;">
                            <div class="text-muted">
                                {{-- 浏览量--}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                </svg>
                                {{ $dynamic->cache_extends['reads_num'] }}
                            </div>
                            <span class="mx-1">|</span>
                            <a class="text-muted" href="#comment"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1"></path>
                                    <path d="M12 12l0 .01"></path>
                                    <path d="M8 12l0 .01"></path>
                                    <path d="M16 12l0 .01"></path>
                                </svg>
                                {{ $dynamic->cache_extends['comments_count'] }}
                            </a>
                        </div>
                    </div>

                    <article class="card-body topic article markdown text-reset">
                        {!! $dynamic->dynamic_content !!}
                    </article>
                        <div class="px-3 py-3">
                            <div class="hr-text hr-text-left mt-0 mb-3">signature</div>
                            <span class="text-muted">
                                {{$dynamic->userInfo->qianming ?? '这里待渲染签名信息'}}
                            </span>
                        </div>

                    {{--            页脚--}}
                    @if(auth()->check())
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">

                                    {{-- 点赞 --}}
                                    <a style="text-decoration:none;" core-click="like-topic" topic-id="{{ $data->id }}"
                                       class="hvr-icon-bounce cursor-pointer text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                       title="{{__("topic.likes")}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="hvr-icon icon" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"/>
                                        </svg>
                                        <span core-show="topic-likes">{{ $data->likes->count() }}</span>
                                    </a>
                                    {{--                收藏--}}
                                    <a style="text-decoration:none;" core-click="star-topic" topic-id="{{ $data->id }}"
                                       class="hvr-icon-bounce cursor-pointer text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                       title="收藏">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="hvr-icon icon icon-tabler icon-tabler-star"
                                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                                        </svg>
                                        收藏
                                    </a>
                                    {{--                --}}{{--                    举报--}}
                                    {{--                <a data-bs-toggle="modal" data-bs-target="#modal-report" style="text-decoration:none;"--}}
                                    {{--                   core-click="report-topic" topic-id="{{ $data->id }}"--}}
                                    {{--                   class="hvr-icon-pulse cursor-pointer text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom"--}}
                                    {{--                   title="举报">--}}
                                    {{--                    <svg xmlns="http://www.w3.org/2000/svg" class="hvr-icon icon icon-tabler icon-tabler-flag-3"--}}
                                    {{--                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"--}}
                                    {{--                         stroke-linecap="round" stroke-linejoin="round">--}}
                                    {{--                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
                                    {{--                        <path d="M5 14h14l-4.5 -4.5l4.5 -4.5h-14v16"></path>--}}
                                    {{--                    </svg>--}}
                                    {{--                    举报--}}
                                    {{--                </a>--}}
                                    {{--                引用--}}
                                    <a style="text-decoration:none;" core-click="copy" copy-content="[topic topic_id={{$data->id}}]"
                                       message="短代码复制成功!"
                                       class="hvr-icon-bounce cursor-pointer text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                       title="短代码">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-blockquote" width="24"
                                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M6 15h15"></path>
                                            <path d="M21 19h-15"></path>
                                            <path d="M15 11h6"></path>
                                            <path d="M21 7h-6"></path>
                                            <path d="M9 9h1a1 1 0 1 1 -1 1v-2.5a2 2 0 0 1 2 -2"></path>
                                            <path d="M3 9h1a1 1 0 1 1 -1 1v-2.5a2 2 0 0 1 2 -2"></path>
                                        </svg>
                                        短代码
                                    </a>
                                </div>

                                {{--                    右边 footer--}}
                                <div class="col-auto">
                                    {{--            修改记录--}}
                                    @if($data->topic_updated->count())
                                        {{--    修改记录--}}
                                        <div class="modal modal-blur fade" id="topic-updated" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">帖子修订记录</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <script>
                                                        document.addEventListener('alpine:init', () => {
                                                            Alpine.data('user_updated', () => ({
                                                                updateds:[

                                                                ],
                                                                async init() {
                                                                    this.updateds = await (await fetch('/api/topic/get.updated_user', {
                                                                        'method': 'post', headers: {
                                                                            'Content-Type': 'application/json'
                                                                        }, body: JSON.stringify({_token: csrf_token, topic_id: '{{$data->id}}'})
                                                                    })).json().then(res => res.result.result);
                                                                }
                                                            }))
                                                        })
                                                    </script>
                                                    <div class="modal-body">
                                                        <ul x-data="user_updated" class="timeline">
                                                            <template x-for="data in updateds">
                                                                <li class="timeline-event">
                                                                    <div class="timeline-event-icon bg-twitter-lt"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                                        <span class="avatar" :style="{'background-image': 'url('+data.avatar+')'}"></span>
                                                                    </div>
                                                                    <div class="card timeline-event-card">
                                                                        <div class="card-body">
                                                                            <div class="text-muted float-end" x-text="data.formatdate"></div>
                                                                            <h4 x-text="data.username"></h4>
                                                                            <p class="text-muted">在<span x-text="data.date"></span>修改了文章</p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </template>

                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">好的</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="avatar-list avatar-list-stacked">
                                            @php $i = 1; @endphp
                                            @foreach($data->topic_updated as $v)
                                                @if($i<=5)
                                                    <span data-bs-toggle="modal" data-bs-target="#topic-updated"
                                                          class="avatar avatar-sm avatar-rounded"
                                                          style="--tblr-avatar-size:25px;background-image:url({{super_avatar($v->user)}})"></span>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endif

                                            @endforeach
                                            @if(count($data->topic_updated)>5)
                                                <span class="avatar avatar-sm avatar-rounded" data-bs-toggle="modal"
                                                      data-bs-target="#topic-updated"
                                                      style="--tblr-avatar-size:25px;">+{{count($data->topic_updated)}}</span>
                                            @endif
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>


                    @endif

                </div>

            </div>


            @if(isset($data->post->options->disable_comment) && $data->post->options->disable_comment)
                <div class="col-md-12">
                    <div class="border-0 card">
                        <div class="empty">
                            <div class="empty-icon"><!-- Download SVG icon from http://tabler-icons.io/i/mood-sad -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban" width="24"
                                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="12" r="9"></circle>
                                    <line x1="5.7" y1="5.7" x2="18.3" y2="18.3"></line>
                                </svg>
                            </div>
                            <p class="empty-title">禁止评论</p>
                            <p class="empty-subtitle text-muted">
                                此帖子关闭了评论及回复功能
                            </p>
                            @if(!auth()->check())
                                <div class="empty-action">
                                    <a href="/login" class="btn btn-primary">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-login"
                                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                                            <path d="M20 12h-13l3 -3m0 6l-3 -3"></path>
                                        </svg>
                                        登陆
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <!-- 显示评论 -->
                这里应该是评论列表
            @endif

            @if(auth()->check())
                {{-- 举报模态--}}
                @include('layouts.report')
            @endif
        </div>
    </div>
    <div class="col-lg-3">
        <h3 class="mb-3">Top tracks</h3>
        <div class="row row-cards">
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <a class="card card-link" href="/users/1.html" style="padding: 0;">
                            <div class="card-cover card-cover-blurred text-center" style="background-image: url(https://assets.runpod.cn/2023/06/24/1687592670-1_1687592668_9rY8faWgzr.png)">
                                <span class="avatar avatar-xl avatar-thumb avatar-rounded" style="background-image: url({{ $dynamic->userInfo->user_avatar }})"></span>
                            </div>
                            <div class="card-body text-center">
                                <div class="card-title mb-1"><span style="" class="text-reset">zhuchunshu</span></div>
                                <div class="text-muted">作者`{{ $dynamic->userInfo->nick_name }}`，至今共发布{{ $dynamic->user->dynamic_count }}篇文章</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Basic info</div>
                        <div class="mb-2">
                            <!-- Download SVG icon from http://tabler-icons.io/i/book -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path><path d="M3 6l0 13"></path><path d="M12 6l0 13"></path><path d="M21 6l0 13"></path></svg>
                            Went to: <strong>University of Ljubljana</strong>
                        </div>
                        <div class="mb-2">
                            <!-- Download SVG icon from http://tabler-icons.io/i/briefcase -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2"></path><path d="M12 12l0 .01"></path><path d="M3 13a20 20 0 0 0 18 0"></path></svg>
                            Worked at: <strong>Devpulse</strong>
                        </div>
                        <div class="mb-2">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                            Lives in: <strong>Šentilj v Slov. Goricah, Slovenia</strong>
                        </div>
                        <div class="mb-2">
                            <!-- Download SVG icon from http://tabler-icons.io/i/map-pin -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path></svg>
                            From: <strong><span class="flag flag-country-si"></span>
                                Slovenia</strong>
                        </div>
                        <div class="mb-2">
                            <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path><path d="M16 3v4"></path><path d="M8 3v4"></path><path d="M4 11h16"></path><path d="M11 15h1"></path><path d="M12 15v3"></path></svg>
                            Birth date: <strong>13/01/1985</strong>
                        </div>
                        <div>
                            <!-- Download SVG icon from http://tabler-icons.io/i/clock -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 7v5l3 3"></path></svg>
                            Time zone: <strong>Europe/Ljubljana</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <a href="/tags/24.html" class="card card-link text-primary-fg" style="background-color: #000000!important;">
                            <div class="card-stamp">
                                <div class="card-stamp-icon bg-yellow">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-appgallery" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"></path>
                                        <path d="M9 8a3 3 0 0 0 6 0"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">资源分享</h3>
                                <p>好用好玩的资源要分享出来</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <div class="col-auto">
                            <img src="/static/tracks/c976bfc96d5e44820e553a16a6097cd02a61fd2f.jpg" class="rounded-start" alt="Shape of You" width="80" height="80">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                Shape of You
                                <div class="text-secondary">
                                    Ed Sheeran
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <div class="col-auto">
                            <img src="/static/tracks/c9a8350feee77e9345eec4155cddc96694803d1a.jpg" class="rounded-start" alt="Alone" width="80" height="80">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                Alone
                                <div class="text-secondary">
                                    Alan Walker
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <div class="col-auto">
                            <img src="/static/tracks/fe4ee21d30450829e5b172e806b3c1e14ca1e5f3.jpg" class="rounded-start" alt="Langrennsfar" width="80" height="80">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                Langrennsfar
                                <div class="text-secondary">
                                    Ylvis
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <div class="col-auto">
                            <img src="/static/tracks/f4e96086f44c4dff1758b1fc1338cd88c1b5ce9c.jpg" class="rounded-start" alt="Skibidi - Romantic Edition" width="80" height="80">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                Skibidi - Romantic Edition
                                <div class="text-secondary">
                                    Little Big
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <div class="col-auto">
                            <img src="/static/tracks/73f4938130140174efb1cc0a82ececb277e40932.jpg" class="rounded-start" alt="Miracle" width="80" height="80">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                Miracle
                                <div class="text-secondary">
                                    Caravan Palace
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <div class="col-auto">
                            <img src="/static/tracks/cfb2a532996512eff95c4b0d566d067384aaa441.jpg" class="rounded-start" alt="Different World (feat. CORSAK)" width="80" height="80">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                Different World (feat. CORSAK)
                                <div class="text-secondary">
                                    Alan Walker,
                                    K-391,
                                    Sofia Carson,
                                    CORSAK
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
