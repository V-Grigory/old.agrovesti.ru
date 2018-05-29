@extends('layouts.app')

@section('content')

    @php
    $rubriks = App\Rubrik::with(
                    ['articles' => function ($query) {
                        $query->where('on_main', '=', 1);
                    }]
               )->where('on_main', 1)->orderBy('position_number', 'asc')->get();
    @endphp

    @if($rubriks)

        @foreach($rubriks as $rubrik)

            @include("partials.template_on_main_{$rubrik->template_number}")

        @endforeach

    @else
        <div style="text-align:center;margin: 50px 0;font-size: 20px;">Не указано ни одной рубрики для вывода.</div>
    @endif


    {{--<!-- соберем массив баннеров для передачи в partials -->--}}
    {{--@php $banners = \App\Banner::all(); @endphp--}}

    {{--<!-- ТРЕНДЫ -->--}}
    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Тренды</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'trends'])--}}
    {{--</div>--}}

    {{--<!-- ОПЫТ -->--}}
    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Опыт</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'opyt'])--}}
    {{--</div>--}}

    {{--<!-- НАБЛЮДЕНИЕ -->--}}
    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Наблюдение</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'nablyudenie'])--}}
    {{--</div>--}}

    {{--<!-- ИННОВАЦИИ -->--}}
    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Инновации</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>''])--}}
    {{--</div>--}}

    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Селекция и семеноводство</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'semenovodstvo'])--}}
    {{--</div>--}}

    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Агротехника и сервис</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'agrotekhnika-i-servis3004180300'])--}}
    {{--</div>--}}

    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Обработка почвы и посев</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'obrabotka_pochvy'])--}}
    {{--</div>--}}

    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Защита растений</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'zashchitarasteniy'])--}}
    {{--</div>--}}

    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Уборка</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'uborka'])--}}
    {{--</div>--}}

    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Сушка и обработка зерна</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'zernosushilnoe_oborudovanie'])--}}
    {{--</div>--}}

    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Технологии содержания</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'tekhnologii-soderzhaniya3004180302'])--}}
    {{--</div>--}}

    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Доильное оборудование</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'doilnoe-oborudovanie3004180302'])--}}
    {{--</div>--}}

    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Кормление и уход</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'korma_i_dobavki'])--}}
    {{--</div>--}}

    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Цифровое животноводство</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'tsifrovoe-zhivotnovodstvo3004180302'])--}}
    {{--</div>--}}

    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Генетика и селекция</h1>--}}
        {{--</div>--}}
        {{--@include('partials.item_article', ['rubrik_name_en'=>'genetika-i-selektsiya3004180303'])--}}
    {{--</div>--}}


    {{--<!-- СВЕЖИЕ СТАТЬИ -->--}}
    {{--<div class="container">--}}
        {{--<div class="title_block">--}}
            {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
            {{--<h1>Свежие статьи</h1>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-4">--}}
                {{--@include('partials.sideBar_rubriks')--}}
            {{--</div>--}}
            {{--<div class="col-md-8">--}}
                {{--<br />--}}
                {{--@php $articles = \App\Article::with('rubriks')->orderBy('id', 'desc')->take(5)->get(); @endphp--}}
                {{--@foreach($articles as $article)--}}
                    {{--@php //echo $article->name_ru; echo'<pre>';  var_dump($article->rubriks[0]->name_ru); echo'</pre>'; @endphp--}}
                    {{--<div class="item_block_last_art">--}}
                        {{--<a href="#" class="title_rubrik">{{ $article->rubriks[0]->name_ru }}</a>--}}
                        {{--<a href="#" class="title_article">{{ $article->name_ru }}</a>--}}
                        {{--<p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>--}}
                        {{--@php--}}
                            {{--$norm = strip_tags($article->article); $words = explode(' ', $norm);--}}
                            {{--if( sizeof($words) > 35 ) {	$words = array_slice($words, 0, 35); $norm = implode(' ', $words) . ''; }--}}
                        {{--@endphp--}}
                        {{--<p class="content_article">{{ $norm }}</p>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection
