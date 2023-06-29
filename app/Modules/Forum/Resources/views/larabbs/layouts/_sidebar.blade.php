<div class="card ">
    <div class="card-body">
        <a href="{{ route('dynamic.create') }}" class="btn btn-success btn-block" aria-label="Left Align">
            <i class="fas fa-pencil-alt mr-2"></i>  新建帖子
        </a>
    </div>
</div>

@if (!empty($active_users) && count($active_users))
    <div class="card mt-4">
        <div class="card-body active-users pt-2">
            <div class="text-center mt-1 mb-0 text-muted">活跃用户</div>
            <hr class="mt-2">
            @foreach ($active_users as $active_user)
                <a class="media mt-2" href="{{ route('users.show', $active_user->user_id) }}">
                    <div class="media-left media-middle mr-2 ml-1">
                        <img src="{{ $active_user->userInfo->user_avatar }}" width="24px" height="24px" class="media-object">
                    </div>
                    <div class="media-body">
                        <small class="media-heading text-secondary">{{ $active_user->userInfo->nick_name }}</small>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif

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
