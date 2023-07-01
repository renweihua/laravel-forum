@extends('forum::layouts.app')
@section('title', '创建帖子')

@section('content')
    <div class="container">
        <div class="col-md-10 offset-md-1">
            <div class="card ">

                <div class="card-body">
                    <h2 class="">
                        <i class="far fa-edit"></i>
                        @if($dynamic->dynamic_id)
                            编辑帖子
                        @else
                            新建帖子
                        @endif
                    </h2>
                    <hr>
                    @if($dynamic->dynamic_id)
                        <form action="{{ route('dynamics.update', $dynamic->dynamic_id) }}" method="POST" accept-charset="UTF-8">
                            <input type="hidden" name="_method" value="PUT">
                            @else
                                <form action="{{ route('dynamics.store') }}" method="POST" accept-charset="UTF-8">
                                    @endif

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    @include('forum::shared._error')

                                    <div class="form-group">
                                        <input class="form-control" type="text" name="dynamic_title" value="{{ old('dynamic_title', $dynamic->dynamic_title ) }}" placeholder="请填写标题" required />
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control" name="topic_id" required>
                                            <option value="" hidden disabled selected>请选择话题</option>
                                            @foreach ($allTopics as $allTopic)
                                                <option @if(
    (!empty($topic_id) && $topic_id == $allTopic->topic_id)
    || (!empty($dynamic) && $dynamic->topic_id == $allTopic->topic_id)
) selected @endif value="{{ $allTopic->topic_id }}">{{ $allTopic->topic_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" id="markDownDiv">
                                        <div id="editormd_id">
                                            <textarea name="dynamic_content" class="form-control" rows="6" style="display:none;" placeholder="请填入至少三个字符的内容。" required>{{ old('dynamic_content', $dynamic->dynamic_content ) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="well well-sm">
                                        <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2" aria-hidden="true"></i> 保存</button>
                                    </div>
                                </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    {!! editor_css() !!}
@endsection
@section('script')
    {!! editor_js() !!}
@endsection
