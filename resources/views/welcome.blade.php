<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Suministros Americanos</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
           
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            background: rgba(255, 0, 0, 1);
            background: -moz-linear-gradient(-45deg, rgba(255, 0, 0, 1) 0%, rgba(247, 255, 0, 0.76) 4%, rgba(249, 191, 5, 0.35) 11%,
            rgba(253, 82, 13, 0.2) 23%, rgba(255, 18, 18, 0.13) 30%, rgba(255, 18, 18, 0) 43%, rgba(255, 18, 18, 0) 100%);
            background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(255, 0, 0, 1)), color-stop(4%,
            rgba(247, 255, 0, 0.76)), color-stop(11%, rgba(249, 191, 5, 0.35)), color-stop(23%, rgba(253, 82, 13, 0.2)),
            color-stop(30%,
            rgba(255, 18, 18, 0.13)), color-stop(43%, rgba(255, 18, 18, 0)), color-stop(100%, rgba(255, 18, 18, 0)));
            background: -webkit-linear-gradient(-45deg, rgba(255, 0, 0, 1) 0%, rgba(247, 255, 0, 0.76) 4%, rgba(249, 191, 5, 0.35)
            11%,
            rgba(253, 82, 13, 0.2) 23%, rgba(255, 18, 18, 0.13) 30%, rgba(255, 18, 18, 0) 43%, rgba(255, 18, 18, 0) 100%);
            background: -o-linear-gradient(-45deg, rgba(255, 0, 0, 1) 0%, rgba(247, 255, 0, 0.76) 4%, rgba(249, 191, 5, 0.35) 11%,
            rgba(253, 82, 13, 0.2) 23%, rgba(255, 18, 18, 0.13) 30%, rgba(255, 18, 18, 0) 43%, rgba(255, 18, 18, 0) 100%);
            background: -ms-linear-gradient(-45deg, rgba(255, 0, 0, 1) 0%, rgba(247, 255, 0, 0.76) 4%, rgba(249, 191, 5, 0.35) 11%,
            rgba(253, 82, 13, 0.2) 23%, rgba(255, 18, 18, 0.13) 30%, rgba(255, 18, 18, 0) 43%, rgba(255, 18, 18, 0) 100%);
            background: linear-gradient(135deg, rgba(255, 0, 0, 1) 0%, rgba(247, 255, 0, 0.76) 4%, rgba(249, 191, 5, 0.35) 11%,
            rgba(253, 82, 13, 0.2) 23%, rgba(255, 18, 18, 0.13) 30%, rgba(255, 18, 18, 0) 43%, rgba(255, 18, 18, 0) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0000', endColorstr='#ff1212', GradientType=1);

        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .bandera {
                background-image: url(/images/suministros.gif);
                background-repeat: no-repeat;
                background-position: center;
                }
    </style>
</head>

<body class="container">
    <div class="flex-center position-ref full-height bandera">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Entrar</a>
            @else
            <a href="{{ route('login') }}">Acceder</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Registro</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">

            </div>


        </div>
    </div>
</body>

</html>