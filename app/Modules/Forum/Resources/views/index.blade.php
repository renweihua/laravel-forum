@extends('forum::layouts.app')
@section('title', '首页')

@section('content')
    @include('forum::dynamic._dynamics_home')
@endsection

@include('forum::dynamic._dynamics_script_vue')
