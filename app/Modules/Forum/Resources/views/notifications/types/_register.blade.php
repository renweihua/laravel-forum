<li class="media @if(!$loop->last) border-bottom @endif">
    <div class="media-body">
        <div class="media-heading mt-0 mb-1 text-secondary">
            欢迎加入小丑路人社区，
            <small>{{ $notify->notify_content }}</small>

            <span class="meta float-right" title="{{ $notify->time_formatting }}">
                <i class="fa fa-clock-o"></i>
                {{ $notify->time_formatting }}
            </span>
        </div>
    </div>
</li>
