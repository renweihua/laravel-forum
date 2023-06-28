@extends('forum::larabbs.layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')

    <div class="row">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            <div class="card ">
                <img class="card-img-top"
                     src="{{ $user->userInfo->user_avatar }}"
                     alt="{{ $user->userInfo->nick_name }}">
                <div class="card-body">
                    <h5><strong>个人简介</strong></h5>
                    <p>{{ $user->userInfo->basic_extends['user_introduction'] }}</p>
                    <hr>
                    <h5><strong>注册于</strong></h5>
                    <p>{{ $user->userInfo->time_formatting }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="card ">
                <div class="card-body">
                    <h1 class="mb-0" style="font-size:22px;">{{ $user->user_name }} <small>{{ $user->user_email }}</small></h1>
                </div>
            </div>
            <hr>

            {{-- 用户发布的内容 --}}
            <div class="card ">
                <div class="card-body">
                    暂无数据 ~_~
                </div>
            </div>

        </div>
    </div>
@stop