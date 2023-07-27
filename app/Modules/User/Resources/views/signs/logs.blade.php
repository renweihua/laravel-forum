@extends('user::layouts.user_master')

@section('title', getLoginUser()->userInfo->nick_name . ' 的签到日志')

@section('user-content')
    <div class="card">
        <div class="card-header">
            <h4>
                <i class="fa fa-calendar-check-o"></i> 签到日志
            </h4>
        </div>

        <div class="card-body">
            @if ($sign_logs->total())
                <ul class="list-group border-0">
                    @foreach ($sign_logs as $log)
                        <li class="list-group-item pl-2 pr-2 border-right-0 border-left-0 @if($loop->first) border-top-0 @endif">
                            <div class="float-left">{{ $log->created_ip }}</div>
                            <div class="float-right">{{ $log->time_formatting }}</div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="empty-block text-center">暂无数据 ~_~ </div>
            @endif

            {{-- 分页 --}}
            <div class="mt-4 pt-1">
                {!! $sign_logs->render() !!}
            </div>
        </div>
    </div>
@stop
