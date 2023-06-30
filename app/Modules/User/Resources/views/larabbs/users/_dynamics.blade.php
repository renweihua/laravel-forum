@if (count($dynamics))

    <ul class="list-group mt-4 border-0">
        @foreach ($dynamics as $dynamic)
            <li class="list-group-item pl-2 pr-2 border-right-0 border-left-0 @if($loop->first) border-top-0 @endif">
                <a href="{{ route('dynamic.show', [$dynamic->dynamic_id]) }}">
                    {{ $dynamic->dynamic_title }}
                </a>
                <span class="meta float-right text-secondary">
          {{ $dynamic->cache_extends['comments_count'] }} 回复
          <span> ⋅ </span>
          {{ $dynamic->time_formatting }}
        </span>
            </li>
        @endforeach
    </ul>

@else
    <div class="empty-block">暂无数据 ~_~ </div>
@endif

{{-- 分页 --}}
<div class="mt-4 pt-1">
    {!! $dynamics->render() !!}
</div>
