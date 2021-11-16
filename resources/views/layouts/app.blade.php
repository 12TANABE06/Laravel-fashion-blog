<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    

    <!-- Styles -->
    <link rel="preload" href="{{asset("image/5159178_m.jpg")}}" as="image">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/index.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/footer.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="footerFixed">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <li><a class="nav-link" href="/">HOME</a></li>
                                <li><a class="nav-link" href="/profiles/mypage">マイページ</a></li>
                                <li><a class="nav-link" href="/posts/create">新規投稿作成</a></li>
                                <li><a class="nav-link"href="/posts/rank">ランキング</a></li>
                            </li>
                        </ul>
                        <form class="form-inline" class="mr-sm-1" action="/search" method="GET">
                            @csrf
                            <div class="title">
                                <div class="form-group">
                                    <select name="select" class="form-control">
                                        <option value="name">ユーザー名</option>
                                        <option value="tag">タグ</option>
                                        <option value="body">本文</option>
                                    </select>
                                </div>
                                <input name="input" class="form-control mr-sm-1" type="text" placeholder="キーワードを入力"/>
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('ログアウト') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
            
            <div class="footerWrap">
                <footer>
                    <div id="app">
                        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                            <p>@2021 Ryosuke Tanabe</p>
                        </nav>
                    </div>
                </footer>
            </div>
            
    
        </div>
    </div>
</body>
</html>
