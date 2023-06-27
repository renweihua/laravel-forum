@extends('forum::layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
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
    </div>
@endsection
