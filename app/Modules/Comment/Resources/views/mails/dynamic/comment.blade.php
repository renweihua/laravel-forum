@extends('comment::layouts.master')

@section('content')
    <h1>{{ config('app.name') }}</h1>

    <p>
        {{ $content }}
    </p>

    @if($url)
        @component('mail::button', ['url' => $url])
            立即查看
        @endcomponent
    @endif

    <p>
        如果这不是您本人的操作，请忽略此邮件。
    </p>

    © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endsection
