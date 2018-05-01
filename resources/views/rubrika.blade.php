@extends('layouts.app')

@section('content')

    <!-- РУБРИКАТОР И САМА СТАТЬЯ -->
    <div class="container">

        <div class="breadcrumb">
            <a href="/">ГЛАВНАЯ</a>
            <span>/</span>
            <span class="end_breadcrumb">{{ $rubrika_name_ru }}</span>
        </div>

        <div class="row">

            <div class="col-md-9">
                <div class="row">
                @forelse($list_articles as $article)
                     <div class="col-md-4">
                     <div class="item_block item_block_in_rubrik">
                         <img src="{{ asset('images/'.$article->image) }}" />
                         <a href="{{route('article', $article->name_en)}}" class="title_article">{{ $article->name_ru }}</a>
                         <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                         @php
                             $norm = strip_tags($article->article); $words = explode(' ', $norm);
                             if( sizeof($words) > 30 ) { $words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                         @endphp
                         <p class="content_article">{{ $norm }}</p>
                     </div>
                     </div>

                @empty
                    <h2>В данной рубрике статьи отсутствуют</h2>
                @endforelse
                </div>
            </div>

            <div class="col-md-3">

                @include('partials.sideBar_rubriks')

            </div>

        </div>
    </div>

@endsection