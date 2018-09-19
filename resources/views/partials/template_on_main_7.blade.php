
@php
    $articles = '';       /*left_side_articles*/

    foreach( $rubrik['articles'] as $article ) {

        $articles .= '
            <div class="col-md-12" style="padding:0;margin: 10px 0;">
                <div class="col-md-6">
                    <img class="item_article_img item_article_img_wide" src="'. asset('images/'.$article->image) .'" />
                </div>
                <div class="col-md-6">
                    <a class="item_article_title item_article_title_wide" href="'. route('article', $article->name_en) .'">
                        '. $article->name_ru .'
                    </a>
                    <p class="item_article_meta"><span class="fa fa-clock-o"></span>'. date_format($article->updated_at, "d.m.Y H:i:s") .'</p>
                    <p class="item_article_content item_article_content_wide">'. limit_words($article->article, 30) .'</p>
                    <div class="tochki"></div>
                </div>
            </div>';

    }

@endphp


<div class="container">

    <h1 class="title_block_rubrik icon_rubrik_{{ $rubrik->icon_number }}">
        <a class="title_block_rubrik_a" href="/rubrika/articles/{{ $rubrik->name_en }}">{{ $rubrik->name_ru }}</a>
    </h1>

    <div class="row">

        {{-- слева статьи --}}
        <div class="col-md-9" style="padding:0;">

            @php echo $articles; @endphp

        </div>

        {{-- справа 1 главная статья и другие статьи --}}
        <div class="col-md-3">

            @include('partials.other_article_with_image')

            @include('partials.other_articles_with_image')

        </div>

    </div>
</div>