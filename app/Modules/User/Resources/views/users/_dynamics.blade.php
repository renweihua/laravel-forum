@if (count($dynamics))

    <ul class="list-group mt-4 border-0">
        @foreach ($dynamics as $dynamic)
            <li class="list-group-item pl-2 pr-2 border-right-0 border-left-0 @if($loop->first) border-top-0 @endif">
                <a href="{{ $dynamic->link() }}">
                    {{ $dynamic->dynamic_title }}
                </a>
                <small class="meta float-right text-secondary">
                    <i class="fa fa-eye"></i>
                    <span title="最后活跃于：{{ date('Y-m-d H:i', $dynamic->updated_time) }}">
                            {{ $dynamic->cache_extends['reads_num'] }}</span>

                    <span> • </span>
                    <small id="praise" class="cursor-pointer" @click="praise({{$dynamic->dynamic_id}})">
                        <i class="fa {{ $dynamic->is_praise ? 'fa-thumbs-up' : 'fa-thumbs-o-up' }} faa-bounce animated"></i>
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

                    <span> ⋅ </span>
                    {{ $dynamic->time_formatting }}

                    <span> ⋅ </span>
                    {{ $dynamic->last_time_formatting }}
                </small>
            </li>
        @endforeach
    </ul>

@else
    <div class="empty-block text-center">暂无数据 ~_~ </div>
@endif

{{-- 分页 --}}
<div class="mt-4 pt-1">
    {!! $dynamics->render() !!}
</div>
