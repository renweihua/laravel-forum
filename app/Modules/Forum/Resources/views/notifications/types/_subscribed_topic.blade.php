<li class="media @if(!$loop->last) border-bottom @endif">
    <div class="media-body">
        <div class="media-heading mt-0 mb-1 text-secondary">
            您订阅了话题 <a href="{{ route('topic.show', $notify->relation->topic_id) }}">《{{ $notify->relation->topic_name }}》</a>

            <span class="meta float-right" title="{{ $notify->time_formatting }}">
                <i class="fa fa-clock-o"></i>
                {{ $notify->time_formatting }}
            </span>
        </div>
    </div>
</li>
