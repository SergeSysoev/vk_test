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
        <a href="https://oauth.vk.com/authorize?client_id=6776037&display=page&redirect_uri=https://oauth.vk.com/blank.html&scope=friends&response_type=token&v=5.52" class="btn btn-primary pull-right">Login</a>
    </div>
</header>
@yield('content')
</body>
</html>