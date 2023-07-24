<li class="media @if(!$loop->last) border-bottom @endif">
    <div class="media-body">
        <div class="media-heading mt-0 mb-1 text-secondary">
            您订阅的文章
            @if(!$notify->relation)
                <a href="javascript:;" class="text-danger">动态已删除</a>
            @else
                <a href="{{ $notify->relation->link() }}">{{ $notify->relation->dynamic_title }}</a>
            @endif
            有新评论消息

            <span class="meta float-right" title="{{ $notify->time_formatting }}">
                <i class="fa fa-clock-o"></i>
                {{ $notify->time_formatting }}
            </span>
        </div>
    </div>
</li>
