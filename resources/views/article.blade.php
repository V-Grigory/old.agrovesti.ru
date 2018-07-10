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


    {{--<div class="col-md-3">--}}

    {{--@include('partials.sideBar_rubriks')--}}
    {{--@include('partials.sideBar_last_articles_in_cerrunt_rubrik')--}}

    {{--</div>--}}

@endsection