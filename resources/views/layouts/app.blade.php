<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="favicon.ico">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!--[if lt IE 9]><script src="{{ asset('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">
            <img class="main_img" src="{{ asset('images/assets/main.png') }}" />
        </div>

        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    {{--<a class="navbar-brand" href="#">Project name</a>--}}
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Главная</a></li>
                        <li><a href="#about">Тренды</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Опыт <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Урал</a></li>
                                <li><a href="#">Сибирь</a></li>
                                <li><a href="#">Поволжье</a></li>
                                <li><a href="#">Центр</a></li>
                                <li><a href="#">Юг</a></li>
                            </ul>
                        </li>
                        <li><a href="#contact">Инновации</a></li>
                        <li><a href="#contact">Контакты</a></li>
                        <li><a href="#contact">Подписка</a></li>
                    </ul>
                    {{--<ul class="nav navbar-nav navbar-right">--}}
                        {{--<li><a href="../navbar/">Меню</a></li>--}}
                        {{--<li><a href="../navbar-static-top/">Статическое</a></li>--}}
                        {{--<li class="active"><a href="./">Фиксированное</a></li>--}}
                    {{--</ul>--}}
                </div>
            </div>
        </div>

        <div class="container">

            @yield('content')

        </div>


        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </body>
</html>