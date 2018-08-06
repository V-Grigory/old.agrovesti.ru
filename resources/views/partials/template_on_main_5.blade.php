
<div class="container">

    <h1 class="title_block_rubrik icon_rubrik_{{ $rubrik->icon_number }}">
        <a class="title_block_rubrik_a" href="/rubrika/articles/{{ $rubrik->name_en }}">{{ $rubrik->name_ru }}</a>
    </h1>

    <div class="row">

        @php $cnt_div = 0; $count_articles = count($rubrik['articles']); $cnt_art = 0; @endphp
        @foreach($rubrik['articles'] as $article)
            @if($article)

                @php
                    $cnt_div++; $cnt_art++;
                    if($cnt_div == 1) echo '<div>';
                @endphp
                <div class="col-md-6" style="padding:0;margin-bottom:15px;">
                    <div class="col-md-6">
                        <img class="item_article_img" src="{{ asset('images/'.$article->image) }}" />
                    </div>
                    <div class="col-md-6">
                        <a class="item_article_title" href="{{route('article', $article->name_en)}}">
                            {{ $article->name_ru }}
                        </a>
                        <p class="item_article_meta"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                        @php
                            $norm = strip_tags($article->article); $words = explode(' ', $norm);
                            if( sizeof($words) > 15 ) {	$words = array_slice($words, 0, 15); $norm = implode(' ', $words) . ''; }
                        @endphp
                        <p class="item_article_content">{{ $norm }}</p>
                        <div class="tochki"></div>
                    </div>
                </div>
            @php
                if($cnt_div == 2 || $cnt_art == $count_articles) { echo '<div style="clear: both;"></div></div>'; $cnt_div = 0; }
            @endphp

            @endif
        @endforeach

        {{-- последние 4 статьи текущей рубрики --}}
        <div class="row">

            @include('partials.other_horizontal_articles_with_image')

        </div>

    </div>
</div>