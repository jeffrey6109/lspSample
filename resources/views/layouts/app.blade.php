
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LSProduct') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.8/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.8/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.8/dist/js/uikit-icons.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        table.center {
          font-size: 18px;
          text-align:center;
          margin-left: auto;
          margin-right: auto;
        }

        body {
            background-image: url('storage/background/background.jpg');
            background-position: center;
            background-repeat: repeat;
            background-size:auto;
            height:100vh;
            width: 100vw;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <div class="container ">
            <br>
            @include('inc.messages')
            @yield('content')
        </div>
    </div>
</body>
</html>
