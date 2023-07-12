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

                    @if ($notifications->count())
                        <div class="list-unstyled notification-list">
                            @foreach ($notifications as $notify)
                                @if($notify->target_type == Notify::TARGET_TYPE['DYNAMIC'])
                                    @include('forum::notifications.types._dynamic_relation', compact('notify'))
                                @elseif($notify->target_type == Notify::TARGET_TYPE['FOLLOW'])
                                    @include('forum::notifications.types._user_follow', compact('notify'))
                                @elseif($notify->target_type == Notify::TARGET_TYPE['SUBSCRIBE'])
                                    @if($notify->subscribe_type == Notify::SUBSCRIBE_TYPE['TOPIC'])
                                        @include('forum::notifications.types._subscribed_topic', compact('notify'))
                                    @endif
                                @else
                                    <li class="media @if(!$loop->last) border-bottom @endif">
                                        其它类型 --- {{ $notify->target_type }}
                                    </li>
                                @endif
                            @endforeach

                            {!! $notifications->render() !!}
                        </div>

                    @else
                        <div class="empty-block">没有消息通知！</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
