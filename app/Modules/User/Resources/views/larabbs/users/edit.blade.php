@extends('forum::larabbs.layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')
    <div class="container">
        <div class="col-md-8 offset-md-2">

            <div class="card">
                <div class="card-header">
                    <h4>
                        <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.update', $user->user_id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('forum::larabbs.shared._error')

                        <div class="mb-3">
                            <label for="name-field">昵称</label>
                            <input class="form-control" type="text" name="nick_name" id="name-field" value="{{ old('name', $user->userInfo->nick_name) }}" />
                        </div>
                        <div class="well well-sm">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop