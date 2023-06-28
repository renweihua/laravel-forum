@if (count($dynamics))
    <ul class="list-unstyled">
        @foreach ($dynamics as $dynamic)
            <li class="d-flex">
                @if(!empty($dynamic->userInfo))
                <div class="">
                    <a href="{{ route('users.show', [$dynamic->user_id]) }}">
                        <img class="media-object img-thumbnail mr-3" style="width: 52px; height: 52px;" src="{{ $dynamic->userInfo->user_avatar ?? '/default.jpg' }}" title="{{ $dynamic->userInfo->nick_name }}">
                    </a>
                </div>
                @endif

                <div class="flex-grow-1 ms-2">

                    <div class="mt-0 mb-1">
                        <a href="{{ route('dynamic.show', [$dynamic->dynamic_id]) }}" title="{{ $dynamic->dynamic_title }}">
                            {{ $dynamic->dynamic_title }}
                        </a>
                        <a class="float-end" href="{{ route('dynamic.show', [$dynamic->dynamic_id]) }}">
                            <span class="badge bg-secondary rounded-pill"> {{ $dynamic->cache_extends['comments_count'] }} </span>
                        </a>
                    </div>

                    <small class="media-body meta text-secondary">

                        <a class="text-secondary" href="{{ route('topic.show', $dynamic->topic_id) }}" title="{{ $dynamic->topic->topic_name }}">
                            <i class="far fa-folder"></i>
                            {{ $dynamic->topic->topic_name }}
                        </a>

                        <span> • </span>
                        @if(!empty($dynamic->userInfo))
                            <a class="text-secondary" href="{{ route('users.show', [$dynamic->user_id]) }}" title="{{ $dynamic->userInfo->nick_name }}">
                                <i class="far fa-user"></i>
                                {{ $dynamic->userInfo->nick_name }}
                            </a>
                            <span> • </span>
                        @endif
                        <i class="far fa-clock"></i>
                        <span class="timeago" title="最后活跃于：{{ date('Y-m-d H:i', $dynamic->updated_time) }}">{{ $dynamic->last_time_formatting }}</span>
                    </small>

                </div>
            </li>

            @if ( ! $loop->last)
                <hr>
            @endif

        @endforeach
    </ul>

@else
    <div class="empty-block">暂无数据 ~_~ </div>
@endif
