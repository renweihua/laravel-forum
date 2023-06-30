<div class="list-group-item">
    <div class="row g-2 align-items-center">
        <div class="col-auto">
            <img src="{{ $dynamic->dynamic_cover }}" class="rounded" alt="{{ $dynamic->dynamic_title }}" width="40" height="40" onerror="loadErrorImg();" />
        </div>
        <div class="col">
            @if($dynamic->topic)
                <a class="badge d-none d-lg-inline-block" href="{{ route('topic.show', ['topic_id' => $dynamic->topic->topic_id ]) }}">
                    {{ $dynamic->topic->topic_name }}
                </a>
            @endif
            <a href="{{ $dynamic->link() }}" class="text-reset">
                {{ $dynamic->dynamic_title }}
            </a>
            <div class="text-secondary">
                上次活跃 {{ $dynamic->last_time_formatting }}
            </div>
        </div>
        <div class="col-auto text-secondary">
            创建于 {{ $dynamic->time_formatting }}
        </div>
        <div class="col-auto">
            <span title="浏览量" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <i class="fa fa-eye fa-lg"></i>
                {{ $dynamic->cache_extends['reads_num'] }}
            </span>
            <span title="点赞量" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <i class="fa {{ $dynamic->is_praise ? 'fa-thumbs-up' : 'fa-thumbs-o-up' }} fa-lg"></i>
                {{ $dynamic->cache_extends['praises_count'] }}
            </span>
            <span title="收藏量" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <i class="fa {{ $dynamic->is_collection ? 'fa-heartbeat' : 'fa-heart-o' }} fa-lg"></i>
                {{ $dynamic->cache_extends['collections_count'] }}
            </span>
            <a title="评论量" style="text-decoration:none;" href="{{ $dynamic->link() }}#comment" class="text-muted cursor-pointer">
                <i class="fa fa-commenting-o fa-lg"></i>
                <span core-show="topic-likes">{{ $dynamic->cache_extends['comments_count'] }}</span>
            </a>
        </div>
    </div>
</div>
