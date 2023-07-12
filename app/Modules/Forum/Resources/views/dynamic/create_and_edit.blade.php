@extends('forum::layouts.app')
@section('title', '创建帖子')

@section('content')
    <div class="container">
        <div class="col-md-10 offset-md-1">
            <div class="card ">

                <div class="card-body">
                    <h2 class="">
                        <i class="fa fa-edit"></i>
                        @if($dynamic->dynamic_id)
                            编辑帖子
                        @else
                            新建帖子
                        @endif
                    </h2>
                    <hr>
                    @if($dynamic->dynamic_id)
                        <form id="dynamic" action="{{ route('dynamics.update', $dynamic->dynamic_id) }}" method="POST" accept-charset="UTF-8">
                            <input type="hidden" name="_method" value="PUT">
                            @else
                                <form id="dynamic" action="{{ route('dynamics.store') }}" method="POST" accept-charset="UTF-8">
                                    @endif

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    @include('forum::shared._error')

                                    <div class="form-group">
                                        <input class="form-control" type="text" name="dynamic_title" value="{{ old('dynamic_title', $dynamic->dynamic_title ) }}" placeholder="请填写标题" required />
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control" name="topic_id" required>
                                            <option value="" hidden disabled selected>请选择话题</option>
                                            @foreach ($topics as $topic)
                                                <option @if(
                                                        (!empty($topic_id) && $topic_id == $topic->topic_id)
                                                        || (!empty($dynamic) && $dynamic->topic_id == $topic->topic_id)
                                                    ) selected @endif value="{{ $topic->topic_id }}">{{ $topic->topic_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" id="markDownDiv">
                                        <div id="editormd_id">
                                            <textarea name="dynamic_markdown" class="form-control" rows="6" style="display:none;" placeholder="请填入至少三个字符的内容。" required>{{ old('dynamic_markdown', $dynamic->dynamic_markdown ) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="well well-sm">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2" aria-hidden="true"></i> 保存</button>
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
