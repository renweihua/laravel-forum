@extends('forum::layouts.app')

@php
    $user = getLoginUser();
@endphp

@section('title', $user->userInfo->nick_name . ' 的个人中心')

@section('content')
    <style>
        div.user a.nav-link{
            border-bottom: 1px solid #f3f3f3;
            padding: 0.75rem 2.5rem 0.75rem 1.25rem;
            color: rgba(0, 0, 0, 0.5);
        }
        div.user a.nav-link.active {
            color: rgba(0, 0, 0, 0.9);
        }
        ul.nav{
            display: block;
        }
        div.user nav ul li{
            background-color: #ffffff;
        }
        li.active{
            color: #4d83ff;
            background: transparent;
        }
    </style>
    <div class="row user">
        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs user-info">
            <nav class="nav flex-column">
                <ul class="nav">
                    <li class="nav-item {{ active_class(if_route('users.edit')) }}">
                        <a class="nav-link {{ active_class(if_route('users.edit')) }}" href="{{ route('users.edit', [$user->user_id]) }}">基本资料</a>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">修改头像</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">账户设置</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">第三方账户</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">扩展资料</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">消息通知</a>
                    </li>
                    -->
                    <li class="nav-item {{ active_class(if_route('login.logs')) }}">
                        <a class="nav-link {{ active_class(if_route('login.logs')) }}" href="{{ route('login.logs') }}">登录日志</a>
                    </li>
                    <li class="nav-item {{ active_class(if_route('sign.logs')) }}">
                        <a class="nav-link {{ active_class(if_route('sign.logs')) }}" href="{{ route('sign.logs') }}">签到日志</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            @yield('user-content')
        </div>
    </div>
@stop
