@extends('user::layouts.user_master')

@section('title', $user->userInfo->nick_name . ' 的基本资料')

@section('user-content')
    <div class="card">
        <div class="card-header">
            <h4>
                <i class="glyphicon glyphicon-edit"></i> 编辑基本资料
            </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('users.update', $user->user_id) }}" method="POST" accept-charset="UTF-8">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @include('forum::shared._error')

                <div class="mb-3">
                    <label for="name-field">昵称</label>
                    <input class="form-control" type="text" name="nick_name" value="{{ old('nick_name', $user->userInfo->nick_name) }}" />
                </div>
                <div class="mb-3">
                    <label for="name-field">性别</label>
                    <select class="form-control" name="user_sex">
                        <option @if($user->userInfo->user_sex == 0) selected @endif value="0">男</option>
                        <option @if($user->userInfo->user_sex == 1) selected @endif value="1">女</option>
                        <option @if($user->userInfo->user_sex == 2) selected @endif value="2">保密</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name-field">简介</label>
                    <textarea class="form-control" type="text" name="user_introduction">{{ old('user_introduction', $user->userInfo->basic_extends['user_introduction']) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="name-field">所在城市</label>
                    <input class="form-control" type="text" name="location" value="{{ old('name', $user->userInfo->basic_extends['location']) }}" />
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
@stop
