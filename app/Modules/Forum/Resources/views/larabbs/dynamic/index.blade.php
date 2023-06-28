@extends('forum::larabbs.layouts.app')
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
                        <li class="nav-item"><a class="nav-link active" href="#">最后回复</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">最新发布</a></li>
                    </ul>
                </div>

                <div class="card-body">
                    {{-- 话题列表 --}}
                    @include('forum::larabbs.dynamic._dynamic_list', ['dynamics' => $dynamics])
                    {{-- 分页 --}}
                    <div class="mt-5">
                        {!! $dynamics->appends(Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 sidebar">
            @include('forum::larabbs.layouts._sidebar')
        </div>
    </div>

@endsection
