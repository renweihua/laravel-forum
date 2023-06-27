<div class="row row-cards justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">首页</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('topics') }}">话题列表</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="javascript:;">
                            @if($topic->topic_icon) <i class="fa {{ $topic->topic_icon }}"></i> @endif
                            {{ $topic->topic_name }}
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="/tags/1.html">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1 d-none d-sm-block" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M0 0h24v24H0z" stroke="none"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <path d="M12 7v5l3 3"></path>
                            </svg>
                            最新</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tags/1.html?query=publish&amp;page=1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-news" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11"></path>
                                <line x1="8" y1="8" x2="12" y2="8"></line>
                                <line x1="8" y1="12" x2="12" y2="12"></line>
                                <line x1="8" y1="16" x2="12" y2="16"></line>
                            </svg>最新发布</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tags/1.html?query=essence&amp;page=1">
                            <svg width="24" height="24" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" class="icon w-3 h-3 me-1 d-none d-md-block"><g stroke-width="3" fill-rule="evenodd"><path fill="#fff" fill-opacity=".01" d="M0 0h48v48H0z"></path><g stroke="currentColor" fill="none"><path d="M10.636 5h26.728L45 18.3 24 43 3 18.3z"></path><path d="M10.636 5L24 43 37.364 5M3 18.3h42"></path><path d="M15.41 18.3L24 5l8.59 13.3"></path></g></g></svg>精华</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tags/1.html?query=hot&amp;page=1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1 d-none d-md-block" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M0 0h24v24H0z" stroke="none"></path><path d="M12 12c2-2.96 0-7-1-8 0 3.038-1.773 4.741-3 6-1.226 1.26-2 3.24-2 5a6 6 0 1 0 12 0c0-1.532-1.056-3.94-2-5-1.786 3-2.791 3-4 2z"></path></svg>热门</a>
                    </li>
                    <li class="nav-item ms-auto">
                        <div class="dropdown">
                            <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="19" r="1"></circle><circle cx="12" cy="5" r="1"></circle></svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="/topic/create"><svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path><path d="M16 5l3 3"></path></svg>发表</a>                                                                                                </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="list-group card-list-group">
                @if($dynamics)
                    @foreach($dynamics as $key => $dynamic)
                        @include('forum::dynamics.list-card', ['dynamic' => $dynamic])
                    @endforeach
                @endif
                <div class="mt-2">
                    {!! $dynamics->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
