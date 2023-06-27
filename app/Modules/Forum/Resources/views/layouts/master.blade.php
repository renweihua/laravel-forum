<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Music components - {{ getenv('APP_NAME') }}</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="twitter:title" content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta name="twitter:description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <script defer data-api="/stats/api/event" data-domain="preview.tabler.io" src="/stats/js/script.js"></script>
    <meta name="msapplication-TileColor" content=""/>
    <meta name="theme-color" content=""/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="mobile-web-app-capable" content="yes"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="MobileOptimized" content="320"/>
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
    <meta name="canonical" content="https://preview.tabler.io/music.html">
    <meta name="twitter:image:src" content="https://preview.tabler.io/static/og.png">
    <meta name="twitter:site" content="@tabler_ui">
    <meta name="twitter:card" content="summary">
    <meta property="og:image" content="https://preview.tabler.io/static/og.png">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="640">
    <meta property="og:site_name" content="Tabler">
    <meta property="og:type" content="object">
    <meta property="og:title" content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta property="og:url" content="https://preview.tabler.io/static/og.png">
    <meta property="og:description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <!-- CSS files -->
    <link href="/dist/css/tabler.min.css?1685973381" rel="stylesheet"/>
    <link href="/dist/css/tabler-flags.min.css?1685973381" rel="stylesheet"/>
    <link href="/dist/css/tabler-payments.min.css?1685973381" rel="stylesheet"/>
    <link href="/dist/css/tabler-vendors.min.css?1685973381" rel="stylesheet"/>
    <link href="/dist/css/demo.min.css?1685973381" rel="stylesheet"/>

    <link href="/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    @yield('style')
    {{-- Laravel Mix - CSS File --}}
    {{-- <link rel="stylesheet" href="{{ mix('css/forum.css') }}"> --}}
    <script>
        function loadErrorImg(){
            var img = event.srcElement;
            img.src="/logo.jpg";
            img.onerror = null; //控制不要一直跳动
        }
    </script>
</head>
<body >
<script src="/dist/js/demo-theme.min.js?1685973381"></script>
<div class="page">
    <!-- Navbar -->
    @include('forum::layouts.navbars.navbar')
    @include('forum::layouts.navbars.sidebar')
    <div class="page-wrapper">
        <!-- Page header -->
        @yield('page-header')
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                @yield('content')
            </div>
        </div>

        @include('forum::layouts.footers.footer')
    </div>
</div>
@include('forum::layouts.footers.js')
@yield('js')
</body>
</html>
