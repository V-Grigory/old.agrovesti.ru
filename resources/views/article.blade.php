@extends('layouts.app')

@section('content')

    {{-- СТАТЬЯ --}}
    <div class="container">

        <div class="breadcrumb">
            <a href="/">ГЛАВНАЯ</a>
            <span>/</span>
            <a href="/rubrika/articles/@php echo($article['rubriks'][0]->name_en);
                @endphp">@php echo($article['rubriks'][0]->name_ru); @endphp
            </a>
            {{-- статьям НЕ из тильды показываем крошки --}}
            @php if($article->tilda_filename == NULL) { @endphp
                <span>/</span>
                <span class="end_breadcrumb">{{ $article->name_ru }}</span>
            @php } @endphp
        </div>
    </div>

    @php
        if($article->need_pay == 1 && !$is_login) $close_article = true; else $close_article = false;
    @endphp

    @if($close_article)
        <div class="close_article">
    @endif
        {{-- ================================================= --}}
            {{-- если статья из админки --}}
            @if($article->tilda_filename == NULL)

                <div class="container">
                    <h1>{{ $article->name_ru }}</h1>
                    <div class="article_wrap">
                        @php
                            echo($article->article);
                        @endphp
                    </div>
                    <div class="article_meta">
                        <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                    </div>
                </div>
            {{-- иначе статья из тильды --}}
            @else

                <div class="container">
                    <div class="article_meta">
                        <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                    </div>
                </div>
                @php
                    include(public_path().'/tilda/'.$article->tilda_filename);
                @endphp

            @endif
        {{-- ================================================= --}}

    @if($close_article)
            <div class="close_article_bottom_gradient"></div>
        </div>

        <div class="close_article_login">
            <p class="close_article_login_title">Для продолжения чтения войдите в центр опыта и инноваций</p>

            @include('lk.login')

            <div class="container">
                @if( session('reason_access_denied') == 'new_client' )
                    <span class="wait_authorize_title">Вы еще не зарегистрированы в системе.</span><br>
                @endif
                <div class="wait_authorize">
                    Для регистрации и получения доступа к материалам обратитесь в клиентский
                    отдел по телефонам:<br>8-905-858-88-19, 8-905-858-87-34 или по e-mail: agrotmn2016@mail.ru.
                </div>
                <ul class="close_article_ul">
                    <li>Вход осуществляется по номеру мобильного телефона</li>
                    {{--<li>Мы рады новым читателям и предоставляем <b>30 дней бесплатного доступа</b> к статьям и сервисам центра.--}}
                    {{--<br>Введите номер моб. телефона, нажмите Войти — ваш номер будет авторизован и предоставлен доступ в центр на 30 дней</li>--}}
                    <li>Ваш номер будет не доступен другим пользователям</li>
                    <li>Авторизация номера бесплатна и не предполагает явных или скрытых платежей</li>
                </ul>
            </div>
        </div>

    @endif


    {{-- Комментарии --}}
    @if( !$close_article )
        @if( $is_login )

            <div class="container">
                <br>
                {{-- вывод комментов --}}
                @if( count($comments) > 0 ) <p class="comments_title">Комментарии к статье</p> @endif
                @foreach($comments as $comment)
                    {{--@php echo '<pre>'; var_dump($comment); echo '</pre>'; @endphp--}}
                    <div class="item_comment">
                        <div class="item_comment_date"><span class="item_comment_notes">Дата:</span> {{ $comment->updated_at }}</div>
                        <div class="item_comment_client"><span class="item_comment_notes">Автор:</span>
                            {{ $comment->client['i_name'] }} {{ $comment->client['o_name'] }}, {{ $comment->client['company'] }}
                        </div>
                        <div class="item_comment_comment">{{ $comment->comment }}</div>
                    </div>
                @endforeach

                {{-- оставить коммент --}}
                <p class="comment_note" style="border:none;">Оставьте ваш комментарий</p>
                <form method="POST" action="{{ Request::url() }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea class="form-control" name="comment"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="comment_article_id" value="{{$article->id}}" />
                        <input type="hidden" name="comment_client_id" value="{{session('client_id')}}" />
                        <button type="submit" class="btn btn-primary">ОПУБЛИКОВАТЬ</button>
                    </div>
                </form>
            </div>

        @else
            <div class="container"><p class="comment_note">Чтобы обсудить статью с коллегами, авторизуйтесь в системе</p></div>
            @include('lk.login')
        @endif

    @endif

@endsection