<!DOCTYPE html>
<html>
<head>
    <title>Vktest</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<header class="container-fluid main-header">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="menu main">
                    <li>
                        <a href="{{ route('home') }}" class="btn btn-link"><i class="glyphicon glyphicon-equalizer"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 text-right">
                @if(!session('user_id'))
                    <a href="https://oauth.vk.com/authorize?client_id={{config('vk.app_id')}}&display=page&redirect_uri={{route('vk.login')}}&response_type=code&v=5.52" class="btn btn-primary pull-right">Login</a>
                @else
                    <ul class="menu">
                        <li>
                            <a href="{{ route('polls.my') }}" class="btn btn-default">Мои опросы</a>
                        </li>
                    </ul>
                    <div class="user-block">
                        <span class="user-name">{{ session('user_name') }}</span>
                        <img src="{{ session('avatar') }}" alt="{{ session('user_name') }}" class="user-photo">
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>
<main class="container">
    @yield('content')
</main>

<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>