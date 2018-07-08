@extends('layouts.app')

@section('content')

    <!-- РУБРИКАТОР И САМА СТАТЬЯ -->
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

        <div class="row">

            <div class="col-md-12">

                {{-- и заголовок --}}
                @php if($article->tilda_filename == NULL) { @endphp
                    <h1>{{ $article->name_ru }}</h1>
                @php } @endphp

                <div class="article_meta">
                    <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                </div>

                <div class="article_wrap">
                    @php
                        if($article->tilda_filename != NULL) {
                            include(public_path().'/tilda/'.$article->tilda_filename);
                        } else {
                            echo($article->article);
                        }
                    @endphp
                </div>

            </div>

            {{--<div class="col-md-3">--}}

                {{--@include('partials.sideBar_rubriks')--}}
                {{--@include('partials.sideBar_last_articles_in_cerrunt_rubrik')--}}

            {{--</div>--}}

        </div>
    </div>

@endsection