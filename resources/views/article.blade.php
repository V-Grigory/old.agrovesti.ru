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
                <h3 class="h3_rubriks">СВЕЖИЕ СТАТЬИ</h3>
                @php $last_articles = \App\Article::with('rubriks')->orderBy('id', 'desc')->take(5)->get(); @endphp
                @foreach($last_articles as $last_article)
                    @php //echo $article->name_ru; echo'<pre>';  var_dump($article->rubriks[0]->name_ru); echo'</pre>'; @endphp
                    <div class="item_block_last_art">
                        <a href="#" class="title_rubrik">{{ $last_article->rubriks[0]->name_ru }}</a>
                        <a href="#" class="title_article">{{ $last_article->name_ru }}</a>
                        <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $last_article->updated_at }}</p>
                        @php
                            $norm = strip_tags($last_article->article); $words = explode(' ', $norm);
                            if( sizeof($words) > 25 ) {	$words = array_slice($words, 0, 25); $norm = implode(' ', $words) . ''; }
                        @endphp
                        <p class="content_article">{{ $norm }}</p>
                    </div>
                @endforeach
            </div>
            <div class="col-md-8">
                {{--@php echo'<pre>'; var_dump($article['rubriks'][0]->name_ru);echo'</pre>'; @endphp--}}
                <h1>{{ $article->name_ru }}</h1>
                <div class="article_meta">
                    <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                </div>

                <div class="article_wrap">@php echo($article->article); @endphp</div>
                {{--{{ $article->article }}--}}
            </div>
        </div>
    </div>

@endsection