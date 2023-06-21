@extends('forum::layouts.master')

@section('content')
    <div class="col-lg-8">
        <div class="card">
            <div class="list-group card-list-group">
                @if($dynamics)
                    @foreach($dynamics as $key => $dynamic)
                        <div class="list-group-item">
                            <div class="row g-2 align-items-center">
                                <div class="col-auto">
                                    <img src="{{ $dynamic->dynamic_cover }}" class="rounded" alt="{{ $dynamic->dynamic_title }}" width="40" height="40" onerror="loadErrorImg();" />
                                </div>
                                <div class="col">
                                    <span class="badge d-none d-lg-inline-block">
                                        {{ $dynamic->topic->topic_name }}
                                    </span>
                                    <a href="/{{ $dynamic->dynamic_id }}" class="text-reset">
                                        {{ $dynamic->dynamic_title }}
                                    </a>
                                    <div class="text-secondary">
                                        上次活跃 {{ $dynamic->last_time_formatting }}
                                    </div>
                                </div>
                                <div class="col-auto text-secondary">
                                    创建于 {{ $dynamic->time_formatting }}
                                </div>
                                <div class="col-auto">
                                    <span class="text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                          title="浏览量">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                                                  d="M0 0h24v24H0z"
                                                                                                  fill="none"/><circle
                                                cx="12" cy="12" r="2"/><path
                                                d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"/></svg>
                                        {{ $dynamic->cache_extends['reads_num'] }}
                                    </span>
                                    <a href="javascript:;" class="link-secondary">
                                        <button class="switch-icon" data-bs-toggle="switch-icon">
                                            <span class="switch-icon-a text-muted">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                                            </span>
                                            <span class="switch-icon-b text-red">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                                            </span>
                                        </button>
                                        {{ $dynamic->cache_extends['praises_count'] }}
                                    </a>
                                    <a href="javascript:;" class="link-secondary">
                                        <button class="switch-icon" data-bs-toggle="switch-icon">
                                            <span class="switch-icon-a text-muted">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                                            </span>
                                            <span class="switch-icon-b text-red">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                                            </span>
                                        </button>
                                        {{ $dynamic->cache_extends['collections_count'] }}
                                    </a>
                                    <a style="text-decoration:none;" href="javascript:;" class="ms-3 text-muted cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                        <i class="fa fa-commenting-o"></i>
                                        <span core-show="topic-likes">{{ $dynamic->cache_extends['comments_count'] }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <h3 class="mb-3">Top tracks</h3>
        <div class="row row-cards">
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <div class="col-auto">
                            <img src="./static/tracks/c976bfc96d5e44820e553a16a6097cd02a61fd2f.jpg" class="rounded-start" alt="Shape of You" width="80" height="80">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                Shape of You
                                <div class="text-secondary">
                                    Ed Sheeran
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <div class="col-auto">
                            <img src="./static/tracks/c9a8350feee77e9345eec4155cddc96694803d1a.jpg" class="rounded-start" alt="Alone" width="80" height="80">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                Alone
                                <div class="text-secondary">
                                    Alan Walker
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <div class="col-auto">
                            <img src="./static/tracks/fe4ee21d30450829e5b172e806b3c1e14ca1e5f3.jpg" class="rounded-start" alt="Langrennsfar" width="80" height="80">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                Langrennsfar
                                <div class="text-secondary">
                                    Ylvis
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <div class="col-auto">
                            <img src="./static/tracks/f4e96086f44c4dff1758b1fc1338cd88c1b5ce9c.jpg" class="rounded-start" alt="Skibidi - Romantic Edition" width="80" height="80">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                Skibidi - Romantic Edition
                                <div class="text-secondary">
                                    Little Big
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <div class="col-auto">
                            <img src="./static/tracks/73f4938130140174efb1cc0a82ececb277e40932.jpg" class="rounded-start" alt="Miracle" width="80" height="80">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                Miracle
                                <div class="text-secondary">
                                    Caravan Palace
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="row row-0">
                        <div class="col-auto">
                            <img src="./static/tracks/cfb2a532996512eff95c4b0d566d067384aaa441.jpg" class="rounded-start" alt="Different World (feat. CORSAK)" width="80" height="80">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                Different World (feat. CORSAK)
                                <div class="text-secondary">
                                    Alan Walker,
                                    K-391,
                                    Sofia Carson,
                                    CORSAK
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
