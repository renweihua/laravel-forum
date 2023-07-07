@if (isset($topic))
    <div class="card">
        <div class="card-body">
            @if($topic->topic_cover)
                <img src="{{ $topic->topic_cover }}" title="{{ $topic->topic_name }}" />
            @endif
            {{ $topic->topic_name }}
                <a @click="topicFollow" href="javascript:;" class="btn" aria-label="Left Align" style="border-radius: 0.28571429rem;box-shadow: inset 0 0 0 1px rgba(34,36,38,.15);    top: 13px;
    position: absolute;
    z-index: 1;
    right: 20px;">
                    <div v-if="!topic.is_follow" >
                        <i class="fa fa-plus mr-2"></i>
                        订阅 TA
                    </div>
                    <div v-else>
                        <i class="fa fa-check mr-2"></i>
                        已关注
                    </div>
                </a>
        </div>
        <div class="card-body" style="border-top: 1px solid rgba(34,36,38,.1);">
            {{ $topic->topic_description }}

            <a href="{{ route('dynamics.create', ['topic_id' => $topic->topic_id]) }}" class="btn btn-block mt-4" aria-label="Left Align" style="border-radius: 0.28571429rem;box-shadow: inset 0 0 0 1px rgba(34,36,38,.15);color: rgba(0,0,0,.6)!important;">
                <i class="fa fa-pencil mr-2" style="opacity: .8;"></i>  发布内容
            </a>
        </div>
    </div>
@else
    <div class="card">
        <div class="card-body">
            <a href="{{ route('dynamics.create') }}" class="btn btn-block" aria-label="Left Align" style="border-radius: 0.28571429rem;box-shadow: inset 0 0 0 1px rgba(34,36,38,.15);color: rgba(0,0,0,.6)!important;">
                <i class="fa fa-pencil mr-2" style="opacity: .8;"></i>  发布内容
            </a>
        </div>
    </div>
@endif

@include('forum::layouts._active_users')

@include('forum::layouts._friendlinks')
