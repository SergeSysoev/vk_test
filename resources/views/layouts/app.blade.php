<!DOCTYPE html>
<html>
<head>
    <title>Vktest</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<header class="container-fluid main-header">
    <div class="container">
        <div class="row">
            <div class="col-md-4 pull-right">
                @if(!session('user_id'))
                    <a href="https://oauth.vk.com/authorize?client_id={{config('vk.app_id')}}&display=page&redirect_uri={{route('vk.login')}}&response_type=code&v=5.52" class="btn btn-primary pull-right">Login</a>
                @else
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
</body>
</html>