<!-- fixed-top 固定导航栏  -->
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
    <div class="container">
        <!-- Branding Image -->
        <a class="navbar-brand " href="{{ url('/') }}">
            LaraBBS
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link {{ active_class(if_route('home')) }}" href="{{ route('home') }}">首页</a></li>

                <!-- 全部话题 -->
                @if(!empty($topics))
                    <li class="nav-item dropdown">
                        <a class="nav-link {{ active_class((if_route('topic.show'))) }} dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            前10项话题组
                        </a>
                        <div class="dropdown-menu">
                            @foreach($topics as $key => $_topic)
                                @if($key >= 10)
                                    @break
                                @endif
                                <a class="dropdown-item" href="{{ route('topic.show', $_topic->topic_id) }}">{{ $_topic->topic_name }}</a>
                            @endforeach
                        </div>
                    </li>
                @endif
                <!-- 前三项`话题`默认展示成菜单栏 -->
                @if(!empty($topics))
                    @foreach($topics as $key => $_topic)
                        @if($key >= 3)
                            @break
                        @endif
                        <li class="nav-item"><a class="nav-link" href="{{ route('topic.show', $_topic->topic_id) }}">{{ $_topic->topic_name }}</a></li>
                    @endforeach
                @endif

                <li class="nav-item"><a class="nav-link" target="_blank" href="https://www.cnpscy.com">小丑路人·博客</a></li>
                <li class="nav-item"><a class="nav-link" target="_blank" href="https://notes.cnpscy.com">小丑路人·即时通讯与笔记</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">注册</a></li>
                @else
                    <li class="nav-item">
                        <a class="nav-link mt-1 mr-3 font-weight-bold" href="{{ route('dynamics.create') }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </li>
                    <li class="nav-item notification-badge">
                        <a class="nav-link mr-3 badge badge-pill badge-{{ Auth::user()->userInfo->notification_count > 0 ? 'hint' : 'secondary' }} text-white" href="{{ route('notifications.index') }}">
                            {{ Auth::user()->userInfo->notification_count }}
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a title="{{ Auth::user()->userInfo->nick_name }}" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ Auth::user()->userInfo->user_avatar }}" class="img-responsive img-circle" width="30px" height="30px" />
                            {{ Auth::user()->userInfo->nick_name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}">
                                <i class="fa fa-user mr-2"></i>
                                个人中心
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}">
                                <i class="fa fa-edit mr-2"></i>
                                编辑资料
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="logout" href="#">
                                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('您确定要退出吗？');">
                                    {{ csrf_field() }}
                                    <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                                </form>
                            </a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
