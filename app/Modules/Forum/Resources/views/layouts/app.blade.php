<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'LaraBBS') - Laravel 进阶教程</title>
    <meta name="description" content="@yield('description', 'LaraBBS 爱好者社区')" />

    <!-- Styles -->
    <link href="{{ mix('css/forum.css') }}" rel="stylesheet">
</head>

<body>
<div id="app" class="{{ route_class() }}-page">
    <div class="flash-message text-center">
        <p class="alert alert-warning">
            `Laravel`版`小丑路人社区`改版中，与`<a href="https://bbs.cnpscy.com" target="_blank">Hyperf版小丑路人社区</a>`数据互动，此版本改版中……尚未彻底完结！
        </p>
    </div>

    @include('forum::layouts._header')

    <div class="container">

        @include('forum::shared._messages')

        @yield('content')

    </div>

    @include('forum::layouts._footer')
</div>

<!-- Scripts -->
<script src="{{ mix('js/forum.js') }}"></script>
</body>

</html>
