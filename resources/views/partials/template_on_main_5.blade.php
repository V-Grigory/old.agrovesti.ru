
<div class="container">

    <h1 class="title_block_rubrik icon_rubrik_{{ $rubrik->icon_number }}">{{ $rubrik->name_ru }}</h1>

    <div class="row">

        @foreach($rubrik['articles'] as $article)
            @if($article)

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

            @endif
        @endforeach

        <!-- берем последние 4 статьи текущей рубрики -->
        <div class="col-md-12">
            @php
                $other_articles_in_current_rubriks = App\Rubrik::with(
                                ['articles' => function ($query) {
                                    $query->where('on_main', '=', 0)->orderby('updated_at', 'desc')->limit(4);
                                }]
                           )->find($rubrik->id);
            @endphp

            @foreach($other_articles_in_current_rubriks['articles'] as $other_article)
                <div class="col-md-3">
                    <a class="other_articles_link" href="{{route('article', $other_article->name_en)}}">
                        &#9632; {{ $other_article->name_ru }}
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</div>