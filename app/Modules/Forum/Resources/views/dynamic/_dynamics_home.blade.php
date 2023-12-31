<div class="row mb-5">
    <div class="col-lg-9 col-md-9 topic-list">
        @if (isset($topic))
            <div class="alert alert-info" role="alert">
                {{ $topic->topic_name }} ：{{ $topic->topic_description }}
            </div>
            <a @click="topicFollow" href="javascript:;" class="btn" aria-label="Left Align" style="border-radius: 0.28571429rem;box-shadow: inset 0 0 0 1px rgba(34,36,38,.15);    top: 5px;
    position: absolute;
    z-index: 1;
    right: 25px;
    background-color: #b7e3d399;">
                <div v-if="!topic.is_follow" >
                    <i class="fa fa-plus mr-2"></i>
                    订阅 TA
                </div>
                <div v-else>
                    <i class="fa fa-check mr-2"></i>
                    已订阅
                </div>
            </a>
        @endif
        @if (isset($search) && !empty($search))
            <div class="alert alert-info" role="alert">
                检索：有{{ $dynamics->total() }}个 <b><code>{{ $search }}</code></b> 相关的内容
            </div>
        @endif

        <div class="card">
            <div class="card-header bg-transparent">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class($tab == 'default') }}" href="{{ Request::url() }}?tab=default">
                            活跃
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(if_query('tab', 'recent')) }}" href="{{ Request::url() }}?tab=recent">
                            最新发布
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(if_query('tab', 'featured')) }}" href="{{ Request::url() }}?tab=featured">
                            精选
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(if_query('tab', 'zeroComment')) }}" href="{{ Request::url() }}?tab=zeroComment">
                            零评论
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(if_query('tab', 'follow')) }}" href="{{ Request::url() }}?tab=follow">
                            关注
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                {{-- 话题列表 --}}
                @include('forum::dynamic._dynamic_list', ['dynamics' => $dynamics])
                {{-- 分页：超过1页才展示页码 --}}
                @if($dynamics->lastPage() > 1)
                    <div class="mt-5">
                        {!! $dynamics->appends(Request::except('page'))->render() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 sidebar">
        @include('forum::layouts._sidebar')
    </div>
</div>
