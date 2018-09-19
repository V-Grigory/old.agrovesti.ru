@extends('layouts.app')

@section('content')

    {{-- СТАТЬИ В РУБРИКЕ И РУБРИКАТОР --}}
    <div class="container">

        <div class="breadcrumb">
            <a href="/">ГЛАВНАЯ</a>
            <span>/</span>
            <span class="end_breadcrumb">{{ $rubrika_name_ru }}</span>
        </div>

        <div class="row">

            <div class="col-md-9">
                <div class="row">
                    @php $cnt_div = 0; $count_articles = count($list_articles); $cnt_art = 0; @endphp
                    @forelse($list_articles as $article)
                        @php
                        $cnt_div++; $cnt_art++;
                        if($cnt_div == 1) echo '<div>';
                        @endphp
                        <div class="col-md-4">
                             <div class="item_article">
                                 <img class="item_article_img" src="{{ asset('images/'.$article->image) }}" />
                                 <a class="item_article_title" href="{{route('article', $article->name_en)}}">{{ $article->name_ru }}</a>
                                 <p class="item_article_meta"><span class="fa fa-clock-o"></span>{{ date_format($article->updated_at, "d.m.Y H:i:s") }}</p>
                                 @php
                                     $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                     if( sizeof($words) > 30 ) { $words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                                 @endphp
                                 <p class="item_article_content">{{ $norm }}</p>
                                 <div class="tochki"></div>
                             </div>
                        </div>
                        @php
                        if($cnt_div == 3 || $cnt_art == $count_articles) { echo '<div style="clear: both;"></div></div>'; $cnt_div = 0; }
                        @endphp
                    @empty
                        <h2>В данной рубрике статьи отсутствуют</h2>
                    @endforelse
                </div>

                {{-- пагинация --}}
                @if( $page_previous != 0 || $page_next != 'no_articles_more' )
                    <nav aria-label="Page navigation example" style="text-align: center;">
                        <ul class="pagination">
                            @if($page_previous != 0)
                                <li class="page-item"><a class="page-link" href="?p={{$page_previous}}">Назад</a></li>
                            @endif
                            {{--<li class="page-item"><a class="page-link" href="#">1</a></li>--}}
                            {{--<li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                            {{--<li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                            @if($page_next != 'no_articles_more')
                                <li class="page-item"><a class="page-link" href="?p={{$page_next}}">Вперед</a></li>
                            @endif
                        </ul>
                    </nav>
                @endif

            </div>

            <div class="col-md-3">

                @include('partials.sideBar_rubriks')

            </div>

        </div>
    </div>

@endsection