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

            {{-- если статья из админки --}}
            @if($article->tilda_filename == NULL)

                <div class="container">
                    <h1>{{ $article->name_ru }}</h1>
                    <div class="article_meta">
                        <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                    </div>
                    <div class="article_wrap">
                        @php
                            echo($article->article);
                        @endphp
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

    @if($close_article)
            <div class="close_article_bottom_gradient"></div>
        </div>

        <div class="close_article_login">
            <p class="close_article_login_title">Для продолжения чтения авторизуйтесь в системе</p>
            @include('lk.login')
        </div>

    @endif

    {{--<div class="col-md-3">--}}

    {{--@include('partials.sideBar_rubriks')--}}
    {{--@include('partials.sideBar_last_articles_in_cerrunt_rubrik')--}}

    {{--</div>--}}

@endsection