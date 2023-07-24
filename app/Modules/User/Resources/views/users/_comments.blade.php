@if (count($comments))
    <ul class="list-group mt-4 border-0">
        @foreach ($comments as $comment)
            <li class="list-group-item pl-2 pr-2 border-right-0 border-left-0 @if($loop->first) border-top-0 @endif">
                <a href="{{ $comment->dynamic->link(['#reply' . $comment->comment_id]) }}">
                    {{ $comment->dynamic->dynamic_title }}
                </a>

                <div class="reply-content text-secondary mt-2 mb-2">
                    {!! $comment->comment_content !!}
                </div>

                <div class="text-secondary" style="font-size:0.9em;">
                    <i class="fa fa-clock-o"></i>
                    评论于 {{ $comment->time_formatting }}
                </div>
            </li>
        @endforeach
    </ul>
@else
    <div class="empty-block text-center">暂无数据 ~_~ </div>
@endif

{{-- 分页 --}}
<div class="mt-4 pt-1">
    {!! $comments->appends(Request::except('page'))->render() !!}
</div>
