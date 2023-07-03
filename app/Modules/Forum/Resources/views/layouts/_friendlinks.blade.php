<!-- 友情链接 -->
@if (!empty($friendlinks) && count($friendlinks))
    <div class="card mt-4">
        <div class="card-body pt-2">
            <div class="text-center mt-1 mb-0 text-muted">友情链接</div>
            <hr class="mt-2 mb-3">
            @foreach ($friendlinks as $friendlink)
                <a class="media mt-1" href="{{ $friendlink->link_url }}" title="{{ $friendlink->link_name }}">
                    <div class="media-body">
                        <span class="media-heading text-muted">{{ $friendlink->link_name }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif
