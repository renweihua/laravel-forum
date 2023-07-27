@extends('forum::layouts.app')
@section('title', '功能列表')

@section('content')
    <div class="row mb-5">
        <div class="col-lg-9 col-md-9">
            <div class="card">
                <div class="card-body">
                    <div id="layout">
                        <div id="test-editormd-view">
                            <textarea style="display:none;" name="test-editormd-markdown-doc"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 sidebar">
            @include('forum::layouts._sidebar')
        </div>
    </div>
@endsection


@section('style')
    {!! editor_css() !!}
@endsection
@section('script')
    {!! editor_only_js() !!}
    <script>
        var testEditor;
        $(function () {
            $.get("/get-functions", function(markdown) {
                testEditor = editormd.markdownToHTML("test-editormd-view", {
                    markdown        : markdown ,//+ "\r\n" + $("#append-test").text(),
                    //htmlDecode      : true,       // 开启 HTML 标签解析，为了安全性，默认不开启
                    htmlDecode      : "style,script,iframe",  // you can filter tags decode
                    //toc             : false,
                    tocm            : true,    // Using [TOCM]
                    // tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
                    emoji           : true,
                    taskList        : true,
                    tex             : true,  // 默认不解析
                    flowChart       : true,  // 默认不解析
                    sequenceDiagram : true,  // 默认不解析
                });
            });
        })
    </script>
@endsection
