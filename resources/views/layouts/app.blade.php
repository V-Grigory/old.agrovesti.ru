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

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!--[if lt IE 9]><script src="{{ asset('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        @php /* если страница тильдовская */
            if(isset($page->source)) {
                //if ($handle = opendir(public_path().'/tilda/js')) {
                //    while (false !== ($file = readdir($handle))) {
                //       if($file != '.' && $file != '..') {
                //            echo '<script src="/tilda/js/'.$file.'"></script>';
                //        }
                //    }
                //}
                if ($handle = opendir(public_path().'/tilda/css')) {
                    while (false !== ($file = readdir($handle))) {
                        if($file != '.' && $file != '..') {
                            echo '<link href="/tilda/css/'.$file.'" rel="stylesheet">';
                        }
                    }
                }
                closedir($handle);
            }
        @endphp
        <script src="/tilda/js/jquery-1.10.2.min.js"></script>
        <script src="/tilda/js/tilda-scripts-2.8.min.js"></script>
        <script src="/tilda/js/tilda-animation-1.0.min.js"></script>
        <script src="/tilda/js/tilda-blocks-2.7.js"></script>
        <script src="/tilda/js/lazyload-1.3.min.js"></script>
    </head>

    <body>
        <div class="container">
            {{--<img class="main_img" src="{{ asset('main.png') }}" />--}}
            <img class="main_img" src="/images/assets/main.png" />
        </div>

        <div class="wrap_main_menu">
        <div class="navbar navbar-default navbar-fixed-top navbar-absolute" role="navigation">
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
                        {{--<li class="active"><a class="with_delimiter" href="/">Главная</a></li>--}}
                        <li><a href="/">Главная</a></li>
                        <li><a href="{{route('rubrika', 'trends')}}">Тренды</a></li>
                        <li><a href="{{route('rubrika', 'opyt')}}">Опыт</a></li>
                        {{--<li class="dropdown">--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">ОПЫТ <b class="caret"></b></a>--}}
                            {{--<ul class="dropdown-menu">--}}
                                {{--<li><a href="#">Урал</a></li>--}}
                                {{--<li><a href="#">Сибирь</a></li>--}}
                                {{--<li><a href="#">Поволжье</a></li>--}}
                                {{--<li><a href="#">Центр</a></li>--}}
                                {{--<li><a href="#">Юг</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        <li><a href="{{route('rubrika', 'innovacii')}}">Инновации</a></li>
                        <li><a href="/kontakty">Контакты</a></li>
                        <li><a class="lid lk" href="/kontakty">Войти</a></li>
                        <li><a class="lid subscribe" href="/kontakty">Подписаться</a></li>
                        <li><a class="lid search" href="/">&nbsp;</a></li>
                    </ul>
                    <div style="display: none;">
                        <img src="/images/assets/logIn_hover.png" />
                        <img src="/images/assets/subscribe_hover.png" />
                        <img src="/images/assets/search_hover.png" />
                    </div>
                    {{--<ul class="nav navbar-nav navbar-right">--}}
                        {{--<li><a href="../navbar/">Меню</a></li>--}}
                        {{--<li><a href="../navbar-static-top/">Статическое</a></li>--}}
                        {{--<li class="active"><a href="./">Фиксированное</a></li>--}}
                    {{--</ul>--}}
                </div>
            </div>
        </div>
        </div>

        @yield('content')


        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <a href="/"><img src="{{ asset('images/assets/logo-footer.png') }}" /></a>
                        <p class="footer_left_content">"Аграрные Известия" - профессиональный опыт, мнения руководителей предприятий АПК, производственные решения для сельского хозяйства.</p>
                    </div>
                    <div class="col-md-4">
                        <h2 class="footer_h2">КОНТАКТЫ</h2>
                        <p class="footer_contact footer_contact_title">ООО «Издательский Дом «Аграрные известия»</p>
                        <p class="footer_contact footer_contact_p">г. Тюмень, ул. Осипенко, 81, офис 3/22</p>
                        <p class="footer_contact footer_contact_phone"><span class="fa fa-phone"></span>8 (3452) 595-202, 595-203, 595-204, 595-206</p>
                        <p class="footer_contact footer_contact_email"><span class="fa fa-envelope"></span>agrogazeta@inbox.ru</p>
                    </div>
                    <div class="col-md-5">
                        <h2 class="footer_h2">ПОЛЕЗНЫЕ ССЫЛКИ</h2>
                        <a class="footer_link" href="/images/assets/mediaKit_2017.pdf" target="_blank">Медиа-кит</a>
                        <a class="footer_link" href="/kontakty">Контакты</a>
                        <a class="footer_link" href="/kontakty">Подписаться</a>
                    </div>
                </div>
            </div>
        </footer>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/my.js') }}"></script>
    </body>
</html>