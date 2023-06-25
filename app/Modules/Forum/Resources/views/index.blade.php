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
                                    @if($dynamic->topic)
                                        <span class="badge d-none d-lg-inline-block">
                                            {{ $dynamic->topic->topic_name }}
                                        </span>
                                    @endif
                                    <a href="{{ route('dynamic.show', ['dynamic_id' => $dynamic->dynamic_id]) }}" class="text-reset">
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
                                    <span title="浏览量" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                        <i class="fa fa-eye"></i>
                                        {{ $dynamic->cache_extends['reads_num'] }}
                                    </span>
                                    <span title="浏览量" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                        <i class="fa {{ $dynamic->is_praise ? 'fa-thumbs-up' : 'fa-thumbs-o-up' }}"></i>
                                        {{ $dynamic->cache_extends['praises_count'] }}
                                    </span>
                                        <span title="浏览量" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                        <i class="fa {{ $dynamic->is_collection ? 'fa-heartbeat' : 'fa-heart-o' }}"></i>
                                        {{ $dynamic->cache_extends['collections_count'] }}
                                    </span>
                                    <a style="text-decoration:none;" href="javascript:;" class="text-muted cursor-pointer">
                                        <i class="fa fa-commenting-o"></i>
                                        <i class="fa fa-comments"></i>
                                        <span core-show="topic-likes">{{ $dynamic->cache_extends['comments_count'] }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="mt-2">
                    {!! $dynamics->links() !!}
                </div>
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
                            <img src="/static/tracks/c976bfc96d5e44820e553a16a6097cd02a61fd2f.jpg" class="rounded-start" alt="Shape of You" width="80" height="80">
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
                            <img src="/static/tracks/c9a8350feee77e9345eec4155cddc96694803d1a.jpg" class="rounded-start" alt="Alone" width="80" height="80">
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
                            <img src="/static/tracks/fe4ee21d30450829e5b172e806b3c1e14ca1e5f3.jpg" class="rounded-start" alt="Langrennsfar" width="80" height="80">
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
                            <img src="/static/tracks/f4e96086f44c4dff1758b1fc1338cd88c1b5ce9c.jpg" class="rounded-start" alt="Skibidi - Romantic Edition" width="80" height="80">
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
                            <img src="/static/tracks/73f4938130140174efb1cc0a82ececb277e40932.jpg" class="rounded-start" alt="Miracle" width="80" height="80">
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
                            <img src="/static/tracks/cfb2a532996512eff95c4b0d566d067384aaa441.jpg" class="rounded-start" alt="Different World (feat. CORSAK)" width="80" height="80">
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
