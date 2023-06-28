@if(!empty($menus))
    <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        @php
                            // 默认为2组展示子菜单
                            $group = 2;
                            // 每组最多展示5项
                            $max_limit = 5;
                        @endphp
                        @foreach($menus as $menu)
                            <li class="nav-item @if(!empty($menu['_childs'])) dropdown @endif">
                                @if(!empty($menu['_childs']))
                                    <a class="nav-link dropdown-toggle" title="{{ $menu['menu_name'] }}" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                                        <span>
                                            <i class="fa fa-fw fa-lg {{ $menu['menu_icon'] }}"></i>
                                        </span>
                                        <span class="nav-link-title">{{ $menu['menu_name'] }}</span>
                                    </a>
                                    <!-- 子菜单 -->
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-columns">
                                            @foreach($menu['_childs'] as $child)
                                                <!-- 至少分两组，左右排序；默认每组最多5项，超出则增加列 -->
                                                @php
                                                    // 总数量
                                                    $loop_count = $loop->count;
                                                    if ($loop_count > $group * $max_limit){
                                                        $group = ceil($loop_count / $max_limit);
                                                    }
                                                @endphp
                                                @if($loop->index % $max_limit == 0)
                                                    <div class="dropdown-menu-column" style="min-width:auto;">
                                                @endif
                                                    @if(!empty($child['_childs']))
                                                        <div class="dropend">
                                                            <a class="dropdown-item dropdown-toggle" href="#sidebar-authentication" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                                                                Authentication
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a href="./sign-in.html" class="dropdown-item">
                                                                    Sign in
                                                                </a>
                                                                <a href="./sign-in-link.html" class="dropdown-item">
                                                                    Sign in link
                                                                </a>
                                                                <a href="./sign-in-illustration.html" class="dropdown-item">
                                                                    Sign in with illustration
                                                                </a>
                                                                <a href="./sign-in-cover.html" class="dropdown-item">
                                                                    Sign in with cover
                                                                </a>
                                                                <a href="./sign-up.html" class="dropdown-item">
                                                                    Sign up
                                                                </a>
                                                                <a href="./forgot-password.html" class="dropdown-item">
                                                                    Forgot password
                                                                </a>
                                                                <a href="./terms-of-service.html" class="dropdown-item">
                                                                    Terms of service
                                                                </a>
                                                                <a href="./auth-lock.html" class="dropdown-item">
                                                                    Lock screen
                                                                </a>
                                                                <a href="./2-step-verification.html" class="dropdown-item">
                                                                    2 step verification
                                                                </a>
                                                                <a href="./2-step-verification-code.html" class="dropdown-item">
                                                                    2 step verification code
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <a class="dropdown-item" title="{{ $child['menu_name'] }}" href="{{ $child['menu_url'] }}">
                                                            <i class="fa fa-fw fa-lg {{ $child['menu_icon'] }}"></i>
                                                            {{ $child['menu_name'] }}
                                                        </a>
                                                    @endif
                                                @if($loop->index % $max_limit == $max_limit - 1)
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <a class="nav-link" title="{{ $menu['menu_name'] }}" href="{{ $menu['menu_url'] }}">
                                    <span>
                                        <i class="fa fa-fw fa-lg {{ $menu['menu_icon'] }}"></i>
                                    </span>
                                        <span class="nav-link-title">{{ $menu['menu_name'] }}</span>
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                        <form action="{{ route('search') }}" method="get" autocomplete="off" novalidate>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                                </span>
                                <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search in website">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endif
