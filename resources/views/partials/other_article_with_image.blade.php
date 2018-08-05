
<h3 class="other_articles_h3"><span class="other_articles_h3_narrow">Читайте также</span></h3>

{{-- берем последнюю 1 статью текущей рубрики --}}
@php
    $other_one_article_in_current_rubriks = App\Rubrik::with(
                    ['articles' => function ($query) {
                        $query->where('on_main', '=', 0)->orderby('updated_at', 'desc')->limit(1);
                    }]
               )->find($rubrik->id);
@endphp

@foreach($other_one_article_in_current_rubriks['articles'] as $other_article)

    <div class="item_article">
        <img class="item_article_img" src="{{asset('images/'.$other_article->image)}}" />
        <div class="other_article_wrap_link_meta">
            <a class="other_articles_link" href="{{route('article', $other_article->name_en)}}">
                {{ $other_article->name_ru }}
            </a>
            <p class="item_article_meta" style="margin:0;"><span class="fa fa-clock-o"></span>{{ $other_article->updated_at }}</p>
        </div>
    </div>

@endforeach