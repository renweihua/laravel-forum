@if ($dynamics->total())
    <ul class="list-unstyled">
        @foreach ($dynamics as $dynamic)
            <li class="d-flex" id="dynamic-{{$dynamic->dynamic_id}}">
                @if(!empty($dynamic->userInfo))
                <div class="">
                    <a href="{{ route('users.show', [$dynamic->user_id]) }}">
                        <img class="media-object img-thumbnail mr-3" style="width: 52px; height: 52px;" src="{{ $dynamic->userInfo->user_avatar ?? '/default.jpg' }}" title="{{ $dynamic->userInfo->nick_name }}">
                    </a>
                </div>
                @endif

                <div class="flex-grow-1 ms-2">

                    <div class="mt-0 mb-1">
                        <a href="{{ $dynamic->link() }}" title="{{ $dynamic->dynamic_title }}">
                            {{ $dynamic->dynamic_title }}
                        </a>
                        <a class="float-end" href="{{ $dynamic->link() }}">
                            <span class="badge bg-secondary rounded-pill"> {{ $dynamic->cache_extends['comments_count'] }} </span>
                        </a>
                    </div>

                    <small class="media-body meta text-secondary">
                        @if($dynamic->topic)
                            <a class="text-secondary" href="{{ route('topic.show', $dynamic->topic_id) }}" title="{{ $dynamic->topic->topic_name }}">
                                <i class="fa fa-folder"></i>
                                {{ $dynamic->topic->topic_name }}
                            </a>

                            <span> • </span>
                        @endif
                        @if(!empty($dynamic->userInfo))
                            <a class="text-secondary" href="{{ route('users.show', [$dynamic->user_id]) }}" title="{{ $dynamic->userInfo->nick_name }}">
                                <i class="fa fa-user"></i>
                                {{ $dynamic->userInfo->nick_name }}
                            </a>
                            <span> • </span>
                        @endif
                        <i class="fa fa-clock-o"></i>
                        <span class="timeago" title="最后活跃于：{{ date('Y-m-d H:i', $dynamic->updated_time) }}">{{ $dynamic->last_time_formatting }}</span>
                        <small style="float: right;">
                            <i class="fa fa-eye"></i>
                            <span title="最后活跃于：{{ date('Y-m-d H:i', $dynamic->updated_time) }}">
                            {{ $dynamic->cache_extends['reads_num'] }}</span>

                            <span> • </span>
                            <small id="praise" class="cursor-pointer" @click="praise({{$dynamic->dynamic_id}})">
                                <i class="fa {{ $dynamic->is_praise ? 'fa-thumbs-up' : 'fa-thumbs-o-up' }} faa-vertical animated-hover faa-slow"></i>
                                <span>{{ $dynamic->cache_extends['praises_count'] }}</span>
                            </small>

                            <span> • </span>
                            <small id="collection" class="cursor-pointer" @click="collection({{$dynamic->dynamic_id}})">
                                <i class="fa {{ $dynamic->is_collection ? 'fa-heartbeat' : 'fa-heart-o' }} faa-pulse animated-hover faa-slow"></i>
                                <span>{{ $dynamic->cache_extends['collections_count'] }}</span>
                            </small>

                            <span> • </span>
                            <i class="fa fa-comments-o fa-lg"></i>
                            <span>{{ $dynamic->cache_extends['comments_count'] }}</span>
                        </small>
                    </small>

                </div>
            </li>
            <hr>
        @endforeach
    </ul>
@else
    <div class="empty-block text-center">暂无数据 ~_~ </div>
@endif
