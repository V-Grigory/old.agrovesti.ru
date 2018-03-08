@extends('layouts.app')

@section('content')

    <!-- ТРЕНДЫ -->
    <div class="container">
        <div class="title_block">
            <div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>
            <h1>Тренды</h1>
        </div>
        <div class="row">
            @php $articles = \App\Rubrik::with('articles')->find(29); @endphp
            @foreach($articles['articles'] as $article)
                @if($article->on_main == 1)
                    <div class="col-md-3">
                        <div class="item_block">
                            <img src="{{ asset('images/'.$article->image) }}" />
                            <a href="#" class="title_article">{{ $article->name_ru }}</a>
                            <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                            @php
                                $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                            @endphp
                            <p class="content_article">{{ $norm }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    {{--<!-- ОПЫТ -->--}}
    <div class="container">
        <div class="title_block">
            <div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>
            <h1>Опыт</h1>
        </div>
        <div class="row">
            @php $articles = \App\Rubrik::with('articles')->find(51); @endphp
            @foreach($articles['articles'] as $article)
                @if($article->on_main == 1)
                    <div class="col-md-3">
                        <div class="item_block">
                            <img src="{{ asset('images/'.$article->image) }}" />
                            <a href="#" class="title_article">{{ $article->name_ru }}</a>
                            <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                            @php
                                $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                            @endphp
                            <p class="content_article">{{ $norm }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- НАБЛЮДЕНИЕ -->
    <div class="container">
        <div class="title_block">
            <div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>
            <h1>Наблюдение</h1>
        </div>
        <div class="row">
            @php $articles = \App\Rubrik::with('articles')->find(25); @endphp
            @foreach($articles['articles'] as $article)
                @if($article->on_main == 1)
                    <div class="col-md-3">
                        <div class="item_block">
                            <img src="{{ asset('images/'.$article->image) }}" />
                            <a href="#" class="title_article">{{ $article->name_ru }}</a>
                            <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                            @php
                                $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                            @endphp
                            <p class="content_article">{{ $norm }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- ИННОВАЦИИ -->
    <div class="container">
        <div class="title_block">
            <div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>
            <h1>Инновации</h1>
        </div>
        <div class="row">
            @php $articles = \App\Rubrik::with('articles')->find(26); @endphp
            @foreach($articles['articles'] as $article)
                @if($article->on_main == 1)
                    <div class="col-md-3">
                        <div class="item_block">
                            <img src="{{ asset('images/'.$article->image) }}" />
                            <a href="#" class="title_article">{{ $article->name_ru }}</a>
                            <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                            @php
                                $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                            @endphp
                            <p class="content_article">{{ $norm }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- ТЕХНИКА И ТЕХНОЛОГИИ -->
    <div class="container">
        <div class="title_block">
            <div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>
            <h1>Техника и технологии</h1>
        </div>
        <div class="title_block_livel_2">
            <h2>Обработка почвы</h2>
        </div>
        <div class="row">
            @php $articles = \App\Rubrik::with('articles')->find(41); @endphp
            @foreach($articles['articles'] as $article)
                @if($article->on_main == 1)
                    <div class="col-md-3">
                        <div class="item_block">
                            <img src="{{ asset('images/'.$article->image) }}" />
                            <a href="#" class="title_article">{{ $article->name_ru }}</a>
                            <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                            @php
                                $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                            @endphp
                            <p class="content_article">{{ $norm }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="title_block_livel_2">
            <h2>Посев</h2>
        </div>
        <div class="row">
            @php $articles = \App\Rubrik::with('articles')->find(43); @endphp
            @foreach($articles['articles'] as $article)
                @if($article->on_main == 1)
                    <div class="col-md-3">
                        <div class="item_block">
                            <img src="{{ asset('images/'.$article->image) }}" />
                            <a href="#" class="title_article">{{ $article->name_ru }}</a>
                            <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                            @php
                                $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                            @endphp
                            <p class="content_article">{{ $norm }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="title_block_livel_2">
            <h2>Тракторы</h2>
        </div>
        <div class="row">
            @php $articles = \App\Rubrik::with('articles')->find(42); @endphp
            @foreach($articles['articles'] as $article)
                @if($article->on_main == 1)
                    <div class="col-md-3">
                        <div class="item_block">
                            <img src="{{ asset('images/'.$article->image) }}" />
                            <a href="#" class="title_article">{{ $article->name_ru }}</a>
                            <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                            @php
                                $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                            @endphp
                            <p class="content_article">{{ $norm }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="title_block_livel_2">
            <h2>Уборка</h2>
        </div>
        <div class="row">
            @php $articles = \App\Rubrik::with('articles')->find(45); @endphp
            @foreach($articles['articles'] as $article)
                @if($article->on_main == 1)
                    <div class="col-md-3">
                        <div class="item_block">
                            <img src="{{ asset('images/'.$article->image) }}" />
                            <a href="#" class="title_article">{{ $article->name_ru }}</a>
                            <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                            @php
                                $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                            @endphp
                            <p class="content_article">{{ $norm }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="title_block_livel_2">
            <h2>Кормозаготовка</h2>
        </div>
        <div class="row">
            @php $articles = \App\Rubrik::with('articles')->find(46); @endphp
            @foreach($articles['articles'] as $article)
                @if($article->on_main == 1)
                    <div class="col-md-3">
                        <div class="item_block">
                            <img src="{{ asset('images/'.$article->image) }}" />
                            <a href="#" class="title_article">{{ $article->name_ru }}</a>
                            <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                            @php
                                $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                            @endphp
                            <p class="content_article">{{ $norm }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="title_block_livel_2">
            <h2>Защита и питание растений</h2>
        </div>
        <div class="row">
            @php $articles = \App\Rubrik::with('articles')->find(31); /*and 32*/ @endphp
            @foreach($articles['articles'] as $article)
                @if($article->on_main == 1)
                    <div class="col-md-3">
                        <div class="item_block">
                            <img src="{{ asset('images/'.$article->image) }}" />
                            <a href="#" class="title_article">{{ $article->name_ru }}</a>
                            <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                            @php
                                $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                            @endphp
                            <p class="content_article">{{ $norm }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="title_block_livel_2">
            <h2>Очистка и сушка зерна</h2>
        </div>
        <div class="row">
            @php $articles = \App\Rubrik::with('articles')->find(34); @endphp
            @foreach($articles['articles'] as $article)
                @if($article->on_main == 1)
                    <div class="col-md-3">
                        <div class="item_block">
                            <img src="{{ asset('images/'.$article->image) }}" />
                            <a href="#" class="title_article">{{ $article->name_ru }}</a>
                            <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                            @php
                                $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                            @endphp
                            <p class="content_article">{{ $norm }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="title_block_livel_2">
            <h2>Животноводство</h2>
        </div>
        <div class="row">
            @php $articles = \App\Rubrik::with('articles')->find(38); @endphp
            @foreach($articles['articles'] as $article)
                @if($article->on_main == 1)
                    <div class="col-md-3">
                        <div class="item_block">
                            <img src="{{ asset('images/'.$article->image) }}" />
                            <a href="#" class="title_article">{{ $article->name_ru }}</a>
                            <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                            @php
                                $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                            @endphp
                            <p class="content_article">{{ $norm }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- СВЕЖИЕ СТАТЬИ -->
    <div class="container">
        <div class="title_block">
            <div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>
            <h1>Свежие статьи</h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h3 class="h3_rubriks">РУБРИКИ</h3>
                <div class="wrap_rubriks">
                    @foreach(\App\Rubrik::with('articles')->get() as $rubrik_list)
                        <div class="item_ribrik">
                            <span class="fon_item_rubrik"></span>
                            <a class="link_in_rubrik" href="{{route('wpadmin.rubrik.show', $rubrik_list->id)}}"> {{$rubrik_list->name_ru}} </a>
                            <span class="count_art_in_rubrik">
                                ({{$rubrik_list->articles()->count()}})
                            </span>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="col-md-8">
                <br />
                @php $articles = \App\Article::with('rubriks')->orderBy('id', 'desc')->take(5)->get(); @endphp
                @foreach($articles as $article)
                    @php //echo $article->name_ru; echo'<pre>';  var_dump($article->rubriks[0]->name_ru); echo'</pre>'; @endphp
                    <div class="item_block_last_art">
                        <a href="#" class="title_rubrik">{{ $article->rubriks[0]->name_ru }}</a>
                        <a href="#" class="title_article">{{ $article->name_ru }}</a>
                        <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                        @php
                            $norm = strip_tags($article->article); $words = explode(' ', $norm);
                            if( sizeof($words) > 35 ) {	$words = array_slice($words, 0, 35); $norm = implode(' ', $words) . ''; }
                        @endphp
                        <p class="content_article">{{ $norm }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@endsection
