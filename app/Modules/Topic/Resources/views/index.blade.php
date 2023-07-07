@extends('forum::layouts.app')
@section('title', isset($topic) ? $topic->topic_name : '话题列表')

@section('content')
    @include('forum::dynamic._dynamics_home')
@endsection

@include('forum::dynamic._dynamics_script_vue')
