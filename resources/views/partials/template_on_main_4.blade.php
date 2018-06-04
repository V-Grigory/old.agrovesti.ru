
<div class="container">

    <h1 class="title_block_rubrik icon_rubrik_{{ $rubrik->icon_number }}">{{ $rubrik->name_ru }}</h1>

    <div class="row">

        <!-- слева статьи -->
        <div class="col-md-9" style="padding:0;">

        @foreach($rubrik['articles'] as $article)
            @if($article)

                @if($loop->iteration == 1)
                    <!-- первая статья в широком формате -->
                        <div class="col-md-12" style="padding:0;">
                            <div class="col-md-6">
                                <img class="item_article_img item_article_img_wide" src="{{ asset('images/'.$article->image) }}" />
                            </div>
                            <div class="col-md-6">
                                <a class="item_article_title item_article_title_wide" href="{{route('article', $article->name_en)}}">
                                    {{ $article->name_ru }}
                                </a>
                                <p class="item_article_meta"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                                @php
                                    $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                    if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                                @endphp
                                <p class="item_article_content item_article_content_wide">{{ $norm }}</p>
                                <div class="tochki"></div>
                            </div>
                        </div>
                @else
                    <!-- остальные в ряд -->
                        <div class="col-md-4">
                            <div class="item_article">
                                <img class="item_article_img" src="{{ asset('images/'.$article->image) }}" />
                                <a class="item_article_title" href="{{route('article', $article->name_en)}}">{{ $article->name_ru }}</a>
                                <p class="item_article_meta"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                                @php
                                    $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                    if( sizeof($words) > 20 ) {	$words = array_slice($words, 0, 20); $norm = implode(' ', $words) . ''; }
                                @endphp
                                <p class="item_article_content">{{ $norm }}</p>
                                <div class="tochki"></div>
                            </div>
                        </div>
                    @endif

                @endif
            @endforeach

        </div>

        <!-- справа 1 главная статья и другие статьи -->
        <div class="col-md-3">


            @php $main_article = \App\Article::where([ ['on_main', '=', 1], ['main_article', '=', 1] ])->first(); @endphp
            @if($main_article)
                <div class="item_article">
                    <img class="item_article_img" src="{{ asset('images/'.$main_article->image) }}" />
                    <a class="item_article_title" href="{{route('article', $main_article->name_en)}}">{{ $main_article->name_ru }}</a>
                    <p class="item_article_meta"><span class="fa fa-clock-o"></span>{{ $main_article->updated_at }}</p>
                    @php
                        $norm = strip_tags($main_article->article); $words = explode(' ', $norm);
                        if( sizeof($words) > 20 ) {	$words = array_slice($words, 0, 20); $norm = implode(' ', $words) . ''; }
                    @endphp
                    <p class="item_article_content">{{ $norm }}</p>
                    <div class="tochki"></div>
                </div>
            @endif



            @include('partials.other_articles')

        </div>

    </div>
</div>