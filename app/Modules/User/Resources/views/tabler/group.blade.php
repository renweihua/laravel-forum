@extends('forum::layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title" title="{{ $group->group_name }}">
                <i class="fa {{ $group->group_icon }} fa-lg"></i>
                {{ $group->group_name }}
            </h2>
        </div>
        <div class="card-body">
            <div class="datagrid">
                @foreach($show_group_authorities as $show_group_authority)
                    <div class="datagrid-item" title="{{ $show_group_authority['value'] }}">
                        <div class="datagrid-title">{{ $show_group_authority['key'] }}</div>
                        <div class="datagrid-content">
                            <i class="fa fa-check-circle-o fa-lg"></i>
                            {{ $show_group_authority['value'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div style="margin-bottom: 10px;margin-top: 2rem;">
            <div class="border-0 card">
                <div class="card-status-top" style="background:#206bc4"></div>
                <div class="card-body">
                    <h3 class="card-title">本用户组下的会员列表</h3>
                    <div class="row">
                        @foreach($users as $user)
                            <div class="col-md-6" style="margin-bottom:5px">
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar" style="background-image: url({{ $user->userInfo->user_avatar }})"></span>
                                    </div>
                                    <div class="col">
                                        <a href="/users/1.html" class="text-body d-block text-truncate"><b>{{ $user->userInfo->nick_name }}</b></a>
                                        注册日期: {{ $user->userInfo->time_formatting }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-2">
        {!! $users->links() !!}
    </div>
    <div class="d-flex mt-4">
        <ul class="pagination ms-auto">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                    <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                    prev
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item">
                <a class="page-link" href="#">
                    next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                </a>
            </li>
        </ul>
    </div>
@endsection
