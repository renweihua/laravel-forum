@include('forum::shared._error')

<div class="reply-box {{ $class ?? '' }}">
    @if(Auth::check())
        <form id="comment" action="{{ route('comments.store') }}" method="POST" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="dynamic_id" value="{{ $dynamic->dynamic_id }}" />
            <input type="hidden" name="reply_id" value="{{ $reply_id }}" />
            <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="{{$reply_id ? '支持`markdown`语法' : '请分享你的见解~(支持`markdown`语法)'}}" name="comment_markdown"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-comments-o mr-1"></i> 评论
            </button>
        </form>
    @else
        <a href="{{ route('login') }}" style="text-align: center;display: block;">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-telegram mr-1"></i> 立即登录
            </button>
        </a>
    @endif
</div>
@if(Auth::check())
<hr>
@endif
