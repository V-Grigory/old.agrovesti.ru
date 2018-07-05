@php

    function limit_words($data, $count_words){
        $norm = strip_tags($data);
        $words = explode(' ', $norm);
        if( sizeof($words) > $count_words ) {
            $words = array_slice($words, 0, $count_words);
            $norm = implode(' ', $words) . '';
        }
        return $norm;
    }

    $LS_art = '';       /*left_side_articles*/
    $RS_art_main = '';  /*right_side_article*/

    foreach( $rubrik['articles'] as $article ) {

        if( $article->main_article != 1 ) {

            // статьи в широком формате
            $LS_art .= '
                <div class="col-md-12" style="padding:0;margin: 10px 0;">
                    <div class="col-md-6">
                        <img class="item_article_img item_article_img_wide" src="'. asset('images/'.$article->image) .'" />
                    </div>
                    <div class="col-md-6">
                        <a class="item_article_title item_article_title_wide" href="'. route('article', $article->name_en) .'">
                            '. $article->name_ru .'
                        </a>
                        <p class="item_article_meta"><span class="fa fa-clock-o"></span>'. $article->updated_at .'</p>
                        <p class="item_article_content item_article_content_wide">'. limit_words($article->article, 30) .'</p>
                        <div class="tochki"></div>
                    </div>
                </div>';

        } else {
            // справа главная статья
            $RS_art_main .= '
                <div class="item_article">
                    <img class="item_article_img" src="'. asset('images/'.$article->image) .'" />
                    <a class="item_article_title" href="'. route('article', $article->name_en) .'">'. $article->name_ru .'</a>
                    <p class="item_article_meta"><span class="fa fa-clock-o"></span>'. $article->updated_at .'</p>
                    <p class="item_article_content">'. limit_words($article->article, 30) .'</p>
                    <div class="tochki"></div>
                </div>';
        }

    }

@endphp


<div class="container">

    <h1 class="title_block_rubrik icon_rubrik_{{ $rubrik->icon_number }}">{{ $rubrik->name_ru }}</h1>

    <div class="row">

        {{-- слева статьи --}}
        <div class="col-md-9" style="padding:0;">

            @php echo $LS_art; @endphp

        </div>

        {{-- справа 1 главная статья и другие статьи --}}
        <div class="col-md-3">

            @php echo $RS_art_main; @endphp

            @include('partials.other_articles')

        </div>

    </div>
</div>