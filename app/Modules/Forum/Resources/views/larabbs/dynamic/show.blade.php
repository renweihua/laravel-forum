@extends('forum::larabbs.layouts.app')

@section('title', $dynamic->dynamic_title)
@section('description', make_excerpt($dynamic->dynamic_content))

@section('content')
    <div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
            <div class="card ">
                <div class="card-body">
                    <div class="text-center">
                        作者：{{ $dynamic->userInfo->nick_name }}
                    </div>
                    <hr>
                    <div class="media">
                        <div align="center">
                            <a href="{{ route('user.show', $dynamic->user_id) }}">
                                <img class="thumbnail img-fluid" src="{{ $dynamic->userInfo->user_avatar }}" width="300px" height="300px">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
            <div class="card ">
                <div class="card-body">
                    <h1 class="text-center mt-3 mb-3">
                        {{ $dynamic->dynamic_title }}
                    </h1>

                    <div class="article-meta text-center text-secondary">
                        {{ $dynamic->time_formatting }}
                        ⋅
                        <i class="far fa-comment"></i>
                        {{ $dynamic->cache_extends['comments_count'] }}
                    </div>

                    <div class="topic-body mt-4 mb-4">
                        {!! $dynamic->dynamic_content !!}
                    </div>

                    @can('update', $dynamic)
                        <div class="operate">
                            <hr>
                            <a href="{{ route('dynamic.edit', $dynamic->dynamic_id) }}" class="btn btn-outline-secondary btn-sm" role="button">
                                <i class="far fa-edit"></i> 编辑
                            </a>
                            <form action="{{ route('dynamic.destroy', $dynamic->dynamic_id) }}" method="post"
                                  style="display: inline-block;"
                                  onsubmit="return confirm('您确定要删除吗？');">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-outline-secondary btn-sm">
                                    <i class="far fa-trash-alt"></i> 删除
                                </button>
                            </form>
                        </div>
                    @endcan

                </div>
            </div>

            {{-- 用户回复列表 --}}
            <div class="card topic-reply mt-4">
                <div class="card-body">
                    @includeWhen(Auth::check(), 'forum::larabbs.dynamic._reply_box', ['dynamic' => $dynamic])
                    @include('forum::larabbs.dynamic._reply_list', ['comments' => $dynamic->comments()->with('userInfo')->get()])
                </div>
            </div>

        </div>
    </div>
@endsection
