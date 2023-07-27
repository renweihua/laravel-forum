@extends('forum::layouts.app')
@section('title', '功能列表')

@section('content')
    <div class="row mb-5">
        <div class="col-lg-9 col-md-9">
            <div class="card">
                <div class="card-body">
                    <div id="test-editormd-view">
                        <textarea style="display:none;" name="test-editormd-markdown-doc"></textarea>
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
    <script>
        const app = new window.vue({
                el: '#app', //element
                data: {
                    login_user: @json($login_user ?? []),
                },
                // 重定义解析变量，避免与PHP语法冲突
                delimiters: ['${', '}'],
                // 在 `methods` 对象中定义方法
                methods: {
                    // 签到/打卡
                    async loginUserSign(){
                        if(!this.login_user) return;
                        await userSign().then(res => {
                            Element.Message.success(res.msg);
                            // 同步渲染是否点赞标识
                            this.login_user.user_info.is_sign = res.is_sign;
                        });
                    },
                }
            } // json格式的对象，使用大括号包裹，里面放了键值对，在js中键可以没有引号，多个键值对之间使用，分隔
        );
    </script>
@endsection
