@extends('forum::layouts.app')
@section('title', isset($topic) ? $topic->topic_name : '话题列表')

@section('content')
    <div class="row mb-5">
        <div class="col-lg-9 col-md-9 topic-list">
            @if (isset($topic))
                <div class="alert alert-info" role="alert">
                    {{ $topic->topic_name }} ：{{ $topic->topic_description }}
                </div>
            @endif

            <div class="card ">
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
                    {{-- 分页 --}}
                    <div class="mt-5">
                        {!! $dynamics->appends(Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 sidebar">
            @include('forum::layouts._sidebar')
        </div>
    </div>

@endsection
