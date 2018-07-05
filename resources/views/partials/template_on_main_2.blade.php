
<div class="container">

    {{--<div class="title_block">--}}
        {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
        {{--<h1>{{ $rubrik->name_ru }}</h1>--}}
    {{--</div>--}}
    <h1 class="title_block_rubrik icon_rubrik_1">{{ $rubrik->name_ru }}</h1>

    <div class="row">

        @php $cnt_div = 0; $count_articles = count($rubrik['articles']); $cnt_art = 0; @endphp
        @foreach($rubrik['articles'] as $article)
            @if($article)

                @php
                    $cnt_div++; $cnt_art++;
                    if($cnt_div == 1) echo '<div>';
                @endphp
                <div class="col-md-3">
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
                @php
                    if($cnt_div == 4 || $cnt_art == $count_articles) { echo '<div style="clear: both;"></div></div>'; $cnt_div = 0; }
                @endphp

            @endif
        @endforeach

    </div>
</div>