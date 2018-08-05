
{{-- берем последние 3 статьи текущей рубрики --}}
{{-- отступив 1, т.к. одна уже выводится выше --}}
@php
    $other_articles_in_current_rubriks = App\Rubrik::with(
                    ['articles' => function ($query) {
                        $query->where('on_main', '=', 0)->orderby('updated_at', 'desc')->offset(1)->limit(3);
                    }]
               )->find($rubrik->id);
@endphp

@foreach($other_articles_in_current_rubriks['articles'] as $other_article)

    <div class="other_articles_item">

        <img class="other_articles_item_img" src="{{asset('images/'.$other_article->image)}}" />
        <a class="other_articles_link" href="{{route('article', $other_article->name_en)}}">
            {{ $other_article->name_ru }}
        </a>
        <p class="item_article_meta" style="margin:0;"><span class="fa fa-clock-o"></span>{{ date_format($other_article->updated_at, 'd.m.Y') }}</p>

    </div>

@endforeach