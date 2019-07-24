
<h3 class="other_articles_h3"><span class="other_articles_h3_narrow">Читайте также</span></h3>

@php
    $other_articles_in_current_rubriks = App\Rubrik::with(
                    ['articles' => function ($query) {
                        $query->where('features', 'not like', '%on_main_in_old_site%')
                        ->orderby('updated_at', 'desc')->limit(2);
                    }]
               )->find($rubrik->id);
@endphp

@foreach($other_articles_in_current_rubriks['articles'] as $other_article)

    <div class="item_article">
        <a class="other_articles_link" href="{{route('article', $other_article->name_en)}}">
            {{ $other_article->name_ru }}
        </a>
        <p class="item_article_meta" style="margin:4px 0;"><span class="fa fa-clock-o"></span>{{ date_format($other_article->updated_at, 'd.m.Y') }}</p>
    </div>

@endforeach
