<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="favicon.ico">
        <title>Аграрная Политика - Новое имя общероссийского журнала «Аграрные Известия».
            Обзоры практик управления, повышения рентабельности производства. Инновации. Тренды.</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="yandex-verification" content="bcc728036f546b84" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700" rel="stylesheet">

        <!--[if lt IE 9]><script src="{{ asset('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        @php /* если страница, и она тильдовская */
            if(Route::currentRouteName() != 'rubrika' && isset($article) && $article->tilda_filename != NULL) {
                $files = [];
                if ($handle = opendir(public_path().'/tilda/js')) {
                    while (false !== ($file = readdir($handle))) {
                       if($file != '.' && $file != '..') {
                            $files[filesize(public_path().'/tilda/js/'.$file)] = $file;
                        }
                    }
                }
                krsort($files);
                foreach ($files as $f) {
                    echo '<script src="/tilda/js/'.$f.'"></script>';
                }
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

        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
          (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
              try {
                w.yaCounter47604658 = new Ya.Metrika({
                  id:47604658,
                  clickmap:true,
                  trackLinks:true,
                  accurateTrackBounce:true,
                  webvisor:true
                });
              } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
              s = d.createElement("script"),
              f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
              d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
          })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/47604658" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->

    </head>

    <body>
        <div class="top_menu">
            <div class="container">
                <a class="top_menu_a" href="/rubrika/article/podpiska-v2">ПОДПИСАТЬСЯ</a>
                <a class="top_menu_a" href="/rubrika/article/vasha-istoriya">ВАША ИСТОРИЯ</a>
            </div>
        </div>
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
                        <li><div class="main_menu_delimiter"></div></li>
                        <li><a href="{{route('rubrika', 'trends')}}">Тренды</a></li>
                        <li><div class="main_menu_delimiter"></div></li>
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
                        <li><div class="main_menu_delimiter"></div></li>
                        <li><a href="{{route('rubrika', 'innovacii')}}">Инновации</a></li>
                        <li><div class="main_menu_delimiter"></div></li>
                        <li><a href="/rubrika/article/kontakty-2019">Контакты</a></li>
                        {{--@if(!session()->has('phone'))--}}
                            {{--<li><a class="lid lk" href="/lk">Войти</a></li>--}}
                        {{--@endif--}}
                        @if(session()->has('phone'))
                            <li><a class="lid lk" href="/lk">Профиль</a></li>
                        @endif
                        {{--<li><a class="lid subscribe" href="/rubrika/article/podpishites-seychas">Подписаться</a></li>--}}
                        {{--<li><a class="lid search" href="/">&nbsp;</a></li>--}}
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
                        <div class="wrap_footer_logo">
                            <a class="footer_logo_link" href="/">
                                <img class="footer_logo_img" src="{{ asset('images/assets/logo-footer.png') }}" />
                            </a>
                            <p class="footer_slogan fs1">общероссийский журнал</p>
                            <p class="footer_slogan fs2">онлайн центр опыта и инноваций</p>
                            <div class="footer_notes">
                                <img class="footer_notes_img" src="{{ asset('images/assets/16.png') }}" />
                                <p class="footer_notes_text">
                                    Журнал "Аграрная политика" зарегистрирован в Федеральной
                                    службе по надзору в сфере связи, информационных технологий
                                    и массовых коммуникаций.<br>
                                    Свидетельство: ПИ № ФС 77-71663 от 23.11.2017 г.
                                </p>
                                <div style="clear: both;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="footer_block_title">ЦЕНТРАЛЬНЫЕ ТЕМЫ</div>
                        @php
                        $articles_in_footer = App\Article::where('features', 'like', '%in_footer_block_1%')->get();
                        foreach ($articles_in_footer as $article_in_footer) { @endphp
                            <p style="margin:0;">
                                <a class="footer_block_link" href="{{route('article', $article_in_footer["name_en"])}}">
                                    {{$article_in_footer["name_ru"]}}
                                </a>
                            </p>
                        @php } @endphp
                    </div>

                    <div class="col-md-3">
                        <div class="footer_block_title">РЕКЛАМА</div>
                        @php
                            $articles_in_footer = App\Article::where('features', 'like', '%in_footer_block_2%')->get();
                            foreach ($articles_in_footer as $article_in_footer) { @endphp
                        <p style="margin:0;">
                            <a class="footer_block_link" href="{{route('article', $article_in_footer["name_en"])}}">
                                {{$article_in_footer["name_ru"]}}
                            </a>
                        </p>
                        @php } @endphp
                    </div>

                    <div class="col-md-3">
                        <div class="footer_block_title">КОНТАКТЫ</div>
                        @php
                            $articles_in_footer = App\Article::where('features', 'like', '%in_footer_block_3%')->get();
                            foreach ($articles_in_footer as $article_in_footer) { @endphp
                        <p style="margin:0;">
                            <a class="footer_block_link" href="{{route('article', $article_in_footer["name_en"])}}">
                                {{$article_in_footer["name_ru"]}}
                            </a>
                        </p>
                        @php } @endphp

                        <div class="footer_socNets">
                            <a class="footer_socNets_link" href="http://vk.com/agrovesti" target="_blank" title="ВКонтакте">
                                <img class="footer_socNets_img" src="{{ asset('images/assets/icon_vk.png') }}" />
                            </a>
                            <a class="footer_socNets_link" href="http://facebook.com/groups/agrovesti" target="_blank" title="Facebook">
                                <img class="footer_socNets_img" src="{{ asset('images/assets/icon_fb.png') }}" />
                            </a>
                            <a class="footer_socNets_link" href="http://twitter.com/agrovesti" target="_blank" title="Twitter">
                                <img class="footer_socNets_img" src="{{ asset('images/assets/icon_twitter.png') }}" />
                            </a>
                            <a class="footer_socNets_link" href="http://ok.ru/profile/577033813172" target="_blank" title="Одноклассники">
                                <img class="footer_socNets_img" src="{{ asset('images/assets/icon_ok.png') }}" />
                            </a>
                            <a class="footer_socNets_link" href="http://instagram.com/agrarnaya_politika" target="_blank" title="Instagram">
                                <img class="footer_socNets_img" src="{{ asset('images/assets/icon_instagram.png') }}" />
                            </a>
                        </div>

                    </div>

                    {{--<div class="col-md-3">--}}
                        {{--<a href="/"><img src="{{ asset('images/assets/logo-footer.png--}}
                        {{--<p class="footer_left_content">"Аграрные Известия" - профессиональный опыт, мнения руководителей предприятий АПК, производственные решения для сельского хозяйства.</p>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4">--}}
                        {{--<h2 class="footer_h2">КОНТАКТЫ</h2>--}}
                        {{--<p class="footer_contact footer_contact_title">ООО «Издательский Дом «Аграрные известия»</p>--}}
                        {{--<p class="footer_contact footer_contact_p">г. Тюмень, ул. Осипенко, 81, офис 3/22</p>--}}
                        {{--<p class="footer_contact footer_contact_phone"><span class="fa fa-phone"></span>8 (3452) 595-202, 595-203, 595-204, 595-206</p>--}}
                        {{--<p class="footer_contact footer_contact_email"><span class="fa fa-envelope"></span>agrogazeta@inbox.ru</p>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-5">--}}
                        {{--<h2 class="footer_h2">ПОЛЕЗНЫЕ ССЫЛКИ</h2>--}}
                        {{--<a class="footer_link" href="/images/assets/mediaKit_2017.pdf" target="_blank">Медиа-кит</a>--}}
                        {{--<a class="footer_link" href="/kontakty">Контакты</a>--}}
                        {{--<a class="footer_link" href="/kontakty">Подписаться</a>--}}
                    {{--</div>--}}

                </div>
            </div>

            <!-- Yandex.Metrika informer -->
            <a href="https://metrika.yandex.ru/stat/?id=47604658&amp;from=informer"
               target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/47604658/3_1_FFFFFFFF_EFEFEFFF_0_uniques"
                                                   style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика"
                                                   title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)"
                                                   class="ym-advanced-informer" data-cid="47604658" data-lang="ru" />
            </a>
            <!-- /Yandex.Metrika informer -->

            <hr style="margin-bottom: 0px;border: none;">
            <div class="footer_copyright">
                Copyright 2018. Аграрные Известия
            </div>

        </footer>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/my.js') }}"></script>

        <script type="text/javascript">
          $(document).ready(function() {
            /* === свежий номер бесплатно === */
            $('#call_back').click(function(){
              if ($('#block_form_callBack').css('display') == 'block') {
                $('#block_form_callBack').css('display', 'none');
              } else {
                $('#block_form_callBack').css('display', 'block');
              }
            });
            $('#btn_close_block_form_callBack').click(function(){
                $('#block_form_callBack').css('display', 'none');
            });

            $("#ajax-email").submit(function() {
              var adr_pattern = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
              var num = $("#inputphone").val();
              var prov1 = adr_pattern.test(num);
              //var prov1 = true;
              if (prov1 == true) {
                //alert(num);
                var str = $(this).serialize();
                $.ajax({
                  type: "POST",
                  url: "http://smszerno.ru/site/callbackagrovesti",
                  data: str,
                  success: function(msg) {
                      /*if(msg == 'OK') {
                       result = '<div class="notification_ok">Ваш запрос отправлен! Мы свяжемся с Вами в ближайшее время.</div>';
                       } else {
                       result = msg;
                       }
                       $('#note').html(result);*/
                  }
                });
                //return false;
                $('#note').html('<div class="notification_ok" style="color:green;font-size:12px;font-weight:bold;">Ваш запрос отправлен! Мы свяжемся с Вами в ближайшее время.</div>');
              }
              else $('#note').html('<div class="notification_err" style="color:red;font-size:12px;font-weight:bold;">Не верный формат телефона.</div>'); //alert("NO NO!");
              return false;
            });
          });
        </script>

        {{-- свежий номер бесплатно --}}
        <div id="block_form_callBack" style="bottom:49px;left:5px;position:fixed;background-color:#ffffff;display:none;width:370px;padding:10px;box-shadow: 3px 3px 3px 0 rgba(0, 0, 0, 0.3);border: 1px solid #cccccc;border-radius: 6px;">
            <div id="btn_close_block_form_callBack" style="position: absolute;right: 10px;font-size: 18px;font-weight: bold;line-height: 1;border-radius: 15px;border: 1px solid grey;
                    height: 23px;width: 23px;text-align: center;cursor: pointer;">x</div>
            <p style="padding-bottom:7px;border-bottom:1px solid #e0e0e0;font-size: 13px;">Мы вам отправим один номер журнала<br>бесплатно, для того, чтобы вы смогли ознакомиться с изданием.</p>
            <div class="row" style="margin-left:10px;">
                <div id="note"></div>
            </div>
            <form role="form" id="ajax-email">
                <div class="row" style="margin:10px;">
                    <p style="font-size:13px;">Для кого?</p>
                    <input id="adresat" name="adresat" type="text" placeholder="Сидорова Евгения Федоровича" class="form-control" value="">
                </div>
                <div class="row" style="margin:10px;">
                    <p style="font-size:13px;">Адрес доставки:</p>
                    <textarea name="adress" id="adress" style="" class="form-control" placeholder="625000, Тюменская область, г. Тюмень, ул. Осипенко 81." rows="3"></textarea>
                </div>
                <div class="row" style="margin:10px;">
                    <p style="font-size:13px;">Телефон:</p>
                    <input id="inputphone" name="phone" type="phone" placeholder="8 905 858 99 19" class="form-control" value="">
                </div>
                <div class="row" style="margin:10px;">
                    <p style="font-size:13px;">E-mail:</p>
                    <input id="inputemail" name="email" type="email" placeholder="info@mail.ru" class="form-control" value="">
                </div>
                <div class="row" style="margin:10px;">
                    <button type="submit" class="btn sendemail" style="background-color: #ff6600;color:#ffffff;">Отправить</button>
                </div>
            </form>
        </div>
        <div class="btn btn-primary" id="call_back" style="background-color: #e91e63;border:none;padding:7px 19px;bottom: 3px;left:5px;position:fixed;">СВЕЖИЙ НОМЕР В ПОДАРОК!</div>

    </body>
</html>