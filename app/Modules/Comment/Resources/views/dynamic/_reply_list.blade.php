<ul class="list-unstyled">
    @foreach ($comments as $index => $comment)
        <li class="media" name="reply{{ $comment->comment_id }}" id="reply{{ $comment->comment_id }}">
            <div class="media-left">
                <a href="{{ route('users.show', [$comment->user_id]) }}">
                    <img class="media-object img-thumbnail mr-3" alt="{{ $comment->userInfo->nick_name }}" src="{{ $comment->userInfo->user_avatar }}" style="width:48px;height:48px;" />
                </a>
            </div>

            <div class="media-body">
                <div class="media-heading mt-0 mb-1 text-secondary">
                    <a href="{{ route('users.show', [$comment->user_id]) }}" title="{{ $comment->userInfo->nick_name }}">
                        {{ $comment->userInfo->nick_name }}
                        @if($comment->user_id == $dynamic->user_id)（作者）@endif
                    </a>
                    @if($comment->reply_user != $comment->user_id && $comment->reply_user)
                        <!-- 回复某人 -->
                        回复 <a href="javascript:;">{{ $comment->replyUser->nick_name }}@if($comment->reply_user == $dynamic->user_id)（作者）@endif</a>
                    @endif
                    <span class="text-secondary"> • </span>
                    <span class="meta text-secondary" title="{{ $comment->time_formatting }}">{{ $comment->time_formatting }}</span>

                    {{-- 回复删除按钮 --}}
                    @can('destroy', $comment)
                        <span class="meta float-right">
                            <form action="{{ route('comments.destroy', $comment->comment_id) }}"
                                  onsubmit="return confirm('确定要删除此评论？');"
                                  method="post">
                              {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                              <button type="submit" class="btn btn-default btn-xs pull-left text-secondary">
                                <i class="far fa-trash-alt"></i>
                              </button>
                            </form>
                        </span>
                    @endcan
                </div>
                <div class="reply-content text-secondary">
                    {!! $comment->comment_content !!}
                </div>
                <div class="text-secondary">
                    <small class="cursor-pointer" @click="praiseComment({{$comment->comment_id}})">
                        <i class="fa" :class="[dynamic.is_praise ? 'fa-thumbs-up' : 'fa-thumbs-o-up']"></i>
                        {{ $comment->praise_count }}
                    </small>
                    ⋅
                    <small class="cursor-pointer" onclick="showReply(this)">
                        <i class="fa fa-reply"></i>
                        回复
                    </small>
                </div>
                <div class="text-secondary reply">
                    @includeWhen(Auth::check(), 'comment::dynamic._comment_box', ['dynamic' => $dynamic, 'reply_id' => $comment->comment_id, 'class' => 'hidden'])
                    @include('comment::dynamic._reply_list', ['comments' => $comment->replies])
                </div>
            </div>
        </li>

        @if ( ! $loop->last)
            <hr>
        @endif

    @endforeach
</ul>
