@extends('layouts.app')

@section('content')

    <!-- соберем массив баннеров для передачи в partials -->
    @php $banners = \App\Banner::all(); @endphp

    <!-- ТРЕНДЫ -->
    <div class="container">
        <div class="title_block">
            <div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>
            <h1>Тренды</h1>
        </div>
        @include('partials.item_article', ['rubrik_id'=>'29'])
    </div>

    <!-- ОПЫТ -->
    <div class="container">
        <div class="title_block">
            <div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>
            <h1>Опыт</h1>
        </div>
        @include('partials.item_article', ['rubrik_id'=>'51'])
    </div>

    <!-- НАБЛЮДЕНИЕ -->
    <div class="container">
        <div class="title_block">
            <div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>
            <h1>Наблюдение</h1>
        </div>
        @include('partials.item_article', ['rubrik_id'=>'25'])
    </div>

    <!-- ИННОВАЦИИ -->
    <div class="container">
        <div class="title_block">
            <div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>
            <h1>Инновации</h1>
        </div>
        @include('partials.item_article', ['rubrik_id'=>'26'])
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
        @include('partials.item_article', ['rubrik_id'=>'41'])

        <div class="title_block_livel_2">
            <h2>Посев</h2>
        </div>
        @include('partials.item_article', ['rubrik_id'=>'43'])

        <div class="title_block_livel_2">
            <h2>Тракторы</h2>
        </div>
        @include('partials.item_article', ['rubrik_id'=>'42'])

        <div class="title_block_livel_2">
            <h2>Уборка</h2>
        </div>
        @include('partials.item_article', ['rubrik_id'=>'45'])

        <div class="title_block_livel_2">
            <h2>Кормозаготовка</h2>
        </div>
        @include('partials.item_article', ['rubrik_id'=>'46'])

        <div class="title_block_livel_2">
            <h2>Защита и питание растений</h2>
        </div>
        @include('partials.item_article', ['rubrik_id'=>'31'])

        <div class="title_block_livel_2">
            <h2>Очистка и сушка зерна</h2>
        </div>
        @include('partials.item_article', ['rubrik_id'=>'34'])

        <div class="title_block_livel_2">
            <h2>Животноводство</h2>
        </div>
        @include('partials.item_article', ['rubrik_id'=>'38'])
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
