@extends('layouts.app')

@section('content')

    <!-- ТРЕНДЫ -->
    <div class="container">
        <div class="title_block">
            <div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>
            <h1>Тренды</h1>
        </div>
        <div class="row">

            @php $articles = \App\Rubrik::with('articles')->find(41); @endphp
            @foreach($articles['articles'] as $article)
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
            @endforeach


            {{--<div class="col-md-3">--}}
                {{--<div class="item_block">--}}
                    {{--<img src="{{ asset('images/agrosalon--_620_620.jpg') }}" />--}}
                    {{--<a href="#" class="title_article">ООО «Агропродукт»: удачная интеграция бизнеса в сельское хозяйство</a>--}}
                    {{--<p class="meta_block"><span class="fa fa-clock-o"></span>14.12.2018</p>--}}
                    {{--<p class="content_article">За последнее десятилетие из экзотической для Сибири культуры рапс превратился, пожалуй, в самую востребованную техническую культуру</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-3">--}}
                {{--<div class="item_block">--}}
                    {{--<img src="{{ asset('images/agrosalon--_620_620.jpg') }}" />--}}
                    {{--<a href="#" class="title_article">ООО «Агропродукт»: удачная интеграция бизнеса в сельское хозяйство</a>--}}
                    {{--<p class="meta_block"><span class="fa fa-clock-o"></span>14.12.2018</p>--}}
                    {{--<p class="content_article">За последнее десятилетие из экзотической для Сибири культуры рапс превратился, пожалуй, в самую востребованную техническую культуру</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-3">--}}
                {{--<div class="item_block">--}}
                    {{--<img src="{{ asset('images/agrosalon--_620_620.jpg') }}" />--}}
                    {{--<a href="#" class="title_article">ООО «Агропродукт»: удачная интеграция бизнеса в сельское хозяйство</a>--}}
                    {{--<p class="meta_block"><span class="fa fa-clock-o"></span>14.12.2018</p>--}}
                    {{--<p class="content_article">За последнее десятилетие из экзотической для Сибири культуры рапс превратился, пожалуй, в самую востребованную техническую культуру</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-3">--}}
                {{--<div class="item_block">--}}
                    {{--<img src="{{ asset('images/agrosalon--_620_620.jpg') }}" />--}}
                    {{--<a href="#" class="title_article">ООО «Агропродукт»: удачная интеграция бизнеса в сельское хозяйство</a>--}}
                    {{--<p class="meta_block"><span class="fa fa-clock-o"></span>14.12.2018</p>--}}
                    {{--<p class="content_article">За последнее десятилетие из экзотической для Сибири культуры рапс превратился, пожалуй, в самую востребованную техническую культуру</p>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-3">--}}
                {{--<div class="item_block">--}}
                    {{--<img src="{{ asset('images/agrosalon--_620_620.jpg') }}" />--}}
                    {{--<a href="#" class="title_article">ООО «Агропродукт»: удачная интеграция бизнеса в сельское хозяйство</a>--}}
                    {{--<p class="meta_block"><span class="fa fa-clock-o"></span>14.12.2018</p>--}}
                    {{--<p class="content_article">За последнее десятилетие из экзотической для Сибири культуры рапс превратился, пожалуй, в самую востребованную техническую культуру</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-3">--}}
                {{--<div class="item_block">--}}
                    {{--<img src="{{ asset('images/agrosalon--_620_620.jpg') }}" />--}}
                    {{--<a href="#" class="title_article">ООО «Агропродукт»: удачная интеграция бизнеса в сельское хозяйство</a>--}}
                    {{--<p class="meta_block"><span class="fa fa-clock-o"></span>14.12.2018</p>--}}
                    {{--<p class="content_article">За последнее десятилетие из экзотической для Сибири культуры рапс превратился, пожалуй, в самую востребованную техническую культуру</p>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>


    <!-- ТРЕНДЫ -->
    <div class="container">
        <div class="title_block">
            <div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>
            <h1>Опыт</h1>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="item_block">
                    <img src="{{ asset('images/agrosalon--_620_620.jpg') }}" />
                    <a href="#" class="title_article">Павел Мухин, директор ООО «Пичугино»: «Наши успехи — плод</a>
                    <p class="meta_block"><span class="fa fa-clock-o"></span>14.12.2018</p>
                    <p class="content_article">Костромская область. Традиционными отраслями экономики Костромской области всегда были лесное и сельское хозяйство. Для того чтобы не</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="item_block">
                    <img src="{{ asset('images/agrosalon--_620_620.jpg') }}" />
                    <a href="#" class="title_article">Павел Мухин, директор ООО «Пичугино»: «Наши успехи — плод</a>
                    <p class="meta_block"><span class="fa fa-clock-o"></span>14.12.2018</p>
                    <p class="content_article">Костромская область. Традиционными отраслями экономики Костромской области всегда были лесное и сельское хозяйство. Для того чтобы не</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="item_block">
                    <img src="{{ asset('images/agrosalon--_620_620.jpg') }}" />
                    <a href="#" class="title_article">Павел Мухин, директор ООО «Пичугино»: «Наши успехи — плод</a>
                    <p class="meta_block"><span class="fa fa-clock-o"></span>14.12.2018</p>
                    <p class="content_article">Костромская область. Традиционными отраслями экономики Костромской области всегда были лесное и сельское хозяйство. Для того чтобы не</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="item_block">
                    <img src="{{ asset('images/agrosalon--_620_620.jpg') }}" />
                    <a href="#" class="title_article">Павел Мухин, директор ООО «Пичугино»: «Наши успехи — плод</a>
                    <p class="meta_block"><span class="fa fa-clock-o"></span>14.12.2018</p>
                    <p class="content_article">Костромская область. Традиционными отраслями экономики Костромской области всегда были лесное и сельское хозяйство. Для того чтобы не</p>
                </div>
            </div>
        </div>
    </div>


@endsection
