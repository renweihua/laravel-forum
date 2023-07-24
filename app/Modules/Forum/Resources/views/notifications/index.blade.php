@extends('forum::layouts.app')
@section('title', '我的通知')

@section('content')
    @php
    use App\Modules\Forum\Entities\Notify;
    @endphp
    <div class="container">
        <div class="col-md-10 offset-md-1">
            <div class="card ">
                <div class="card-body">
                    <h3 class="text-xs-center">
                        <i class="fa fa-bell" aria-hidden="true"></i> 我的通知
                    </h3>
                    <hr>

                    @if ($notifications->total())
                        <div class="list-unstyled notification-list">
                            @foreach ($notifications as $notify)
                                @if($notify->target_type == Notify::TARGET_TYPE['REGISTER'])
                                    @include('forum::notifications.types._register', compact('notify'))
                                @elseif($notify->target_type == Notify::TARGET_TYPE['DYNAMIC'])
                                    @switch($notify->dynamic_type)
                                        @case(Notify::DYNAMIC_TARGET_TYPE['PRAISE'])
                                            <!-- 点赞 -->
                                        @case(Notify::DYNAMIC_TARGET_TYPE['COLLECTION'])
                                            <!-- 收藏 -->
                                        @case(Notify::DYNAMIC_TARGET_TYPE['COMMENT'])
                                            <!-- 评论 -->
                                        @case(Notify::DYNAMIC_TARGET_TYPE['REPLY_COMMENT'])
                                            <!-- 回复评论 -->
                                            @include('forum::notifications.types._dynamic_relation.default', compact('notify'))
                                            @break
                                        @case(Notify::DYNAMIC_TARGET_TYPE['COMMENT_PRAISE'])
                                            <!-- 点赞了我的评论 -->
                                            @include('forum::notifications.types._dynamic_relation.comment_praise', compact('notify'))
                                            @break
                                        @case(Notify::DYNAMIC_TARGET_TYPE['SUBSCRIBE_NOTIFY'])
                                            <!-- 订阅的动态，有新消息 -->
                                            @include('forum::notifications.types._dynamic_relation.subscribed-dynamic-new-content', compact('notify'))
                                            @break

                                        @default
                                            {{ $notify->dynamic_type }}
                                    @endswitch
                                @elseif($notify->target_type == Notify::TARGET_TYPE['FOLLOW'])
                                    @include('forum::notifications.types._user_follow', compact('notify'))
                                @elseif($notify->target_type == Notify::TARGET_TYPE['SUBSCRIBE'])
                                    @if($notify->subscribe_type == Notify::SUBSCRIBE_TYPE['TOPIC'])
                                        @include('forum::notifications.types._subscribed_topic', compact('notify'))
                                    @elseif($notify->subscribe_type == Notify::SUBSCRIBE_TYPE['DYNAMIC'])
                                        @include('forum::notifications.types._subscribed_dynamic', compact('notify'))
                                    @endif
                                @else
                                    <li class="media @if(!$loop->last) border-bottom @endif">
                                        其它类型 --- {{ $notify->target_type }} --- 请反馈给管理员！
                                    </li>
                                @endif
                            @endforeach

                            {!! $notifications->render() !!}
                        </div>
                    @else
                        <div class="empty-block text-center">没有消息通知！</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
