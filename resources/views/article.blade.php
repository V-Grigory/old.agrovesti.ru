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
            <span>/</span>
            <span class="end_breadcrumb">{{ $article->name_ru }}</span>
        </div>

        <div class="row">

            <div class="col-md-9">
                {{--@php echo'<pre>'; var_dump($article['rubriks'][0]->name_ru);echo'</pre>'; @endphp--}}
                <h1>{{ $article->name_ru }}</h1>
                <div class="article_meta">
                    <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                </div>

                <div class="article_wrap">@php echo($article->article); @endphp</div>
                {{--{{ $article->article }}--}}
            </div>

            <div class="col-md-3">

                @include('partials.sideBar_rubriks_and_last_articles')

            </div>

        </div>
    </div>

@endsection