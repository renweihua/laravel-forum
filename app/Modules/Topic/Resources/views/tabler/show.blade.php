@extends('forum::layouts.master')

@section('page-header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Topic.Dynamics
                </div>
                <h2 class="page-title">
                    话题`{{ $topic->topic_name }}`·动态列表
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
    <div class="row row-cards justify-content-center">
        <div class="col-md-12">
            <div class="row row-cards justify-content-center">
                <div class="col-lg-9">
                    @include('topic::topic.dynamics')
                </div>
                <div class="col-lg-3">
                    <div class="row row-cards rd">
                        <div class="col-md-12 sticky" style="top: 105px">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-moderator-list" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">版主列表</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="/users/1.html" class="avatar" style="background-image: url(/upload/1/202302/20/EL7wv13Xno0TtBW4_1676904455_Nu9rH6VSqa.jpg)"></a>
                                </div>
                                <div class="col text-truncate">
                                    <a href="/users/1.html" class="text-body d-block">zhuchunshu</a>
                                    <div class="text-muted text-truncate mt-n1"> 一个不会写文档的程序猿。</div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="/users/3.html" class="avatar" style="background-image: url(/upload/images/3/202208/29/6vT8kYb6qX6PAsKh_1661738664_7wSdD3pT5f.gif)"></a>
                                </div>
                                <div class="col text-truncate">
                                    <a href="/users/3.html" class="text-body d-block">Inkedus</a>
                                    <div class="text-muted text-truncate mt-n1"> 这个人没有签名</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">好的</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
    </style>
@endsection
