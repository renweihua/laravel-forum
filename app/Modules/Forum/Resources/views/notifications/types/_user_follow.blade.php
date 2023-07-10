<li class="media @if(!$loop->last) border-bottom @endif">
    <div class="media-left">
        <a href="{{ route('users.show', $notify->sender['user_id']) }}">
            <img class="media-object img-thumbnail mr-3" alt="{{ $notify->sender['nick_name'] }}" src="{{ $notify->sender['user_avatar'] }}" style="width:48px;height:48px;" />
        </a>
    </div>
    <div class="media-body">
        <div class="media-heading mt-0 mb-1 text-secondary">
            <a href="{{ route('users.show', $notify->sender['user_id']) }}">{{ $notify->sender['nick_name'] }}</a>
            {{ $notify->explain }}

            <span class="meta float-right" title="{{ $notify->time_formatting }}">
                <i class="far fa-clock"></i>
                {{ $notify->time_formatting }}
            </span>
        </div>
    </div>
</li>
