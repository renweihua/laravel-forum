@include('forum::larabbs.shared._error')

<div class="reply-box">
    <form action="{{ route('comments.store') }}" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="dynamic_id" value="{{ $dynamic->dynamic_id }}">
        <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="分享你的见解~" name="comment_content"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share mr-1"></i> 回复</button>
    </form>
</div>
<hr>
