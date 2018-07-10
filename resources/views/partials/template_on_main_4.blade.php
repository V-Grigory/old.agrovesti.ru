
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
    $LS_art_main = '';
    $LS_art_last = '';

    $count_articles = count($rubrik['articles']);
    $cnt_art = 0;

    // для оборачивание дивов в блоки по 3 штуки
    $cnt_art_exclude = 1; // общее кол-во статей за вычетом главной и последней статьи
    foreach( $rubrik['articles'] as $article ) { if( $article->main_article == 1 ) $cnt_art_exclude = 2; }
    $cnt_art_div = 0;
    $cnt_div = 0;

    foreach( $rubrik['articles'] as $article ) {

        $cnt_art++;

        if( $article->main_article == 1 ) {

            // ГЛАВНАЯ статья, в широком формате
            $LS_art_main .= '
                <div class="col-md-12" style="padding:0;">
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

        } elseif ($cnt_art == $count_articles) {

            // последняя статья в правую колонку, перед "остальными статьями"
            $LS_art_last .=
                '<div class="item_article">
                     <img class="item_article_img" src="'.asset('images/'.$article->image).'" />
                     <a class="item_article_title" href="'.route('article', $article->name_en).'">'.$article->name_ru.'</a>
                     <p class="item_article_meta"><span class="fa fa-clock-o"></span>'.$article->updated_at.'</p>
                     <p class="item_article_content">'.limit_words($article->article, 20).'</p>
                     <div class="tochki"></div>
                 </div>';

        } else {
            // остальные в ряд
            $cnt_div++; $cnt_art_div++;
            if($cnt_div == 1) $LS_art .= '<div>';

            $LS_art .= '
                <div class="col-md-4">
                    <div class="item_article">
                        <img class="item_article_img" src="'. asset('images/'.$article->image) .'" />
                        <a class="item_article_title" href="'.route('article', $article->name_en).'">'. $article->name_ru .'</a>
                        <p class="item_article_meta"><span class="fa fa-clock-o"></span>'. $article->updated_at .'</p>
                        <p class="item_article_content">'. limit_words($article->article, 20) .'</p>
                        <div class="tochki"></div>
                    </div>
                </div>';

            if($cnt_div == 3 || ($cnt_art_div == $count_articles - $cnt_art_exclude)) {
                $LS_art .= '<div style="clear: both;"></div></div>'; $cnt_div = 0;
            }
        }
    }
@endphp


<div class="container">

    <h1 class="title_block_rubrik icon_rubrik_{{ $rubrik->icon_number }}">
        <a class="title_block_rubrik_a" href="/rubrika/articles/{{ $rubrik->name_en }}">{{ $rubrik->name_ru }}</a>
    </h1>

    <div class="row">

        {{-- LEFT SIDE --}}
        <div class="col-md-9" style="padding:0;">

            @php echo $LS_art_main;  @endphp
            @php echo $LS_art;       @endphp

        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-md-3">

            @php echo $LS_art_last; @endphp

            @include('partials.other_articles')

        </div>

    </div>

</div>