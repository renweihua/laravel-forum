@extends('user::layouts.user_master')

@section('title', getLoginUser()->userInfo->nick_name . ' 的签到日志')

@section('user-content')
    <div class="card">
        <div class="card-header">
            <h4>
                <i class="fa fa-calendar-check-o"></i> 登录日志
            </h4>
        </div>

        <div class="card-body">
            @if ($logs->total())
                <ul class="list-group border-0">
                    <li class="list-group-item pl-2 pr-2 border-right-0 border-left-0 border-top-0">
                        <div class="row">
                            <div class="col-4">登录IP</div>
                            <div class="col-4">登录状态</div>
                            <div class="col-4">登录时间</div>
                        </div>
                    </li>
                    @foreach ($logs as $log)
                        <li class="list-group-item pl-2 pr-2 border-right-0 border-left-0 @if($loop->first) border-top-0 @endif">
                            <div class="row">
                                <div class="col-4">{{ $log->created_ip }}</div>
                                <div class="col-4">{{ $log->description }}</div>
                                <div class="col-4">{{ $log->time_formatting }}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="empty-block text-center">暂无数据 ~_~ </div>
            @endif

            {{-- 分页 --}}
            <div class="mt-4 pt-1">
                {!! $logs->render() !!}
            </div>
        </div>
    </div>
@stop
