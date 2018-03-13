<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">
    <!-- redactor -->
    <link rel="stylesheet" href="/redactor/assets/redactor.css" />

</head>

<body>
    <div id="app">

        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                           Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">

                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="active"><a href="/wpadmin/rubrik">Рубрики</a></li>
                        <li>
                            <a href="#" class="btn btn-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-align: left;">
                                Статьи по рубрикам
                            </a>
                            <div class="dropdown-menu" style="border:none;background-color:#f5f8fa;padding:10px;">
                                @foreach(\App\Rubrik::with('articles')->get() as $rubrik_list)
                                    <a class="dropdown-item" href="{{route('wpadmin.rubrik.show', $rubrik_list->id)}}" style="display:block;line-height:1;padding:2px 0;">
                                        {{$rubrik_list->name_ru}} ({{$rubrik_list->articles()->count()}})
                                    </a>
                                @endforeach
                                {{--<a class="dropdown-item" href="{{route('wpadmin.article.index', 2)}}" style="display:block;line-height:1;padding:2px 0;">переработка id2</a>--}}
                                {{--<a class="dropdown-item" href="{{route('wpadmin.article.index', 3)}}" style="display:block;line-height:1;padding:2px 0;">переработка id3</a>--}}
                            </div>
                        </li>
                        <li><a href="{{route('wpadmin.article.create')}}">Добавить статью</a></li>
                        <li><a href="#">Analytics</a></li>

                        <li><a href="#">Analytics</a></li>


                    </ul>
                </div>

                <div class="col-sm-9 col-md-10 main">

                    @yield('content')

                </div>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/redactor/assets/redactor.js"></script>
    <script type="text/javascript">
        $(function()
        {
            $('#content_article').redactor();
        });
    </script>
</body>
</html>