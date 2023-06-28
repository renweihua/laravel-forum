@extends('forum::layouts.master')

@section('page-header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Topics
                </div>
                <h2 class="page-title">
                    话题列表
                </h2>
            </div>

            <!--
            <div class="col-auto">
                    <a href="/tags/create" class="btn btn-primary">{{__("tag.create")}}</a>
            </div>
            -->
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-cards">
        @if (!empty($topics))
            @foreach ($topics as $topic)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('topic.show', ['topic_id' => $topic->topic_id])}}" class="card" @if($topic->topic_color) style="background-color: {{$topic->topic_color}}!important;" @endif>
                        @if($topic->topic_icon)
                            <div class="card-stamp">
                                <div class="card-stamp-icon bg-yellow">
                                    <i class="fa {!! $topic->topic_icon !!}"></i>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <h3 class="card-title">{{$topic->topic_name}}</h3>
                            <p class="text-secondary topic-description">{!! empty($topic->topic_description) ? '暂无描述。' : $topic->topic_description !!}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-status-top bg-danger"></div>
                    <div class="card-body">
                        <h3 class="card-title">empty data.</h3>
                        <p class="text-secondary">尚未创建话题！</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('style')
    <style>
        p.topic-description{
            height: 40px;
            /*多出的隐藏*/
            overflow: hidden;
            /*多出部分用...代替*/
            text-overflow: ellipsis;
            /*定义为盒子模型显示*/
            display: -webkit-box;
            /*用来限制在一个块元素显示的文本的行数*/
            -webkit-line-clamp: 2;
            /*从上到下垂直排列子元素（设置伸缩盒子的子元素排列方式）*/
            -webkit-box-orient: vertical;
        }
    </style>
@endsection
