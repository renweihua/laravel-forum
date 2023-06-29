<ul class="list-unstyled">
    @foreach ($comments as $index => $comment)
        <li class=" media" name="reply{{ $comment->comment_id }}" id="reply{{ $comment->comment_id }}">
            <div class="media-left">
                <a href="{{ route('users.show', [$comment->user_id]) }}">
                    <img class="media-object img-thumbnail mr-3" alt="{{ $comment->userInfo->nick_name }}" src="{{ $comment->userInfo->user_avatar }}" style="width:48px;height:48px;" />
                </a>
            </div>

            <div class="media-body">
                <div class="media-heading mt-0 mb-1 text-secondary">
                    <a href="{{ route('users.show', [$comment->user_id]) }}" title="{{ $comment->userInfo->nick_name }}">
                        {{ $comment->userInfo->nick_name }}
                    </a>
                    <span class="text-secondary"> • </span>
                    <span class="meta text-secondary" title="{{ $comment->time_formatting }}">{{ $comment->time_formatting }}</span>

                    {{-- 回复删除按钮 --}}
                    <span class="meta float-right">
                        <a title="删除回复">
                          <i class="far fa-trash-alt"></i>
                        </a>
                    </span>
                </div>
                <div class="reply-content text-secondary">
                    {!! $comment->comment_content !!}
                </div>
            </div>
        </li>

        @if ( ! $loop->last)
            <hr>
        @endif

    @endforeach
</ul>