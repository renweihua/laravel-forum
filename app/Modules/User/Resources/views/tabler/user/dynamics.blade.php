<link rel="stylesheet" href="{{ ('plugins/Topic/css/app.css') }}">
<div class="row row-cards">
    <div class="col-md-12">
        <div class="border-0 card card-body">
            <h3 class="card-title">{{ $userInfo->nick_name}} 发布的主题</h3>
            @if(!empty($dynamics))
                <div class="row row-cards">
                    @foreach($dynamics as $dynamic)
                        <article class="col-md-12 p-3 border-bottom hoverable">
                            <div class="d-flex justify-content-between border-0 card">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="/users/{{$dynamic->user_id}}.html" class="avatar"
                                           style="background-image: url({{ $dynamic->userInfo->user_avatar }});--tblr-avatar-size: 3.2rem;">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 markdown home-article">
                                                        <a href="{{ route('dynamic.show', ['dynamic_id' => $dynamic->dynamic_id]) }}" class="text-reset">
                                                            <h3 class="text-muted">
                                                                @if($dynamic->topic)
                                                                    <span class="badge d-none d-lg-inline-block"
                                                                          style="background-color: {{$dynamic->topic->topic_color}}!important;">
                                                                        {{$dynamic->topic->topic_name}}
                                                                    </span>
                                                                    <span class="badge d-inline-block d-lg-none"
                                                                          style="background-color: {{$dynamic->topic->topic_color}}!important;">
                                                                        {!! $dynamic->topic->topic_icon !!}
                                                                    </span>
                                                                @endif
                                                                <span class="badge bg-red">
                                                                    置顶
                                                                </span>
                                                                <span class="badge bg-green d-none d-lg-inline-block">
                                                                    精华
                                                                </span>
                                                                {{$dynamic->dynamic_title}}
                                                            </h3>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="margin-top: 5px">
                                                <div class="d-flex align-items-center">
                                                    <div class="text-muted" style="margin-top:1px">
                                                        <a href="/users/1.html" style="" class="text-muted">zhuchunshu</a>  2小时前
                                                        ←
                                                        <a href="/users/1.html" style="" class="text-muted">zhuchunshu</a>  2小时前
                                                    </div>
                                                    <div class="ms-auto d-none d-lg-inline-block">
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
                                                        <a title="评论量" style="text-decoration:none;" href="javascript:;" class="text-muted cursor-pointer">
                                                            <i class="fa fa-commenting-o fa-lg"></i>
                                                            <span core-show="topic-likes">{{ $dynamic->cache_extends['comments_count'] }}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="mt-2">
                    {{ $dynamics->links() }}
                </div>
            @else
                <div class="empty">
                    <p class="empty-title">尚未`发布动态`！</p>
                </div>
            @endif
        </div>
    </div>
</div>
