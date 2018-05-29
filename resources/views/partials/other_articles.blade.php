
<h3 class="other_articles_h3">ДРУГИЕ СТАТЬИ</h3>

<!-- берем последние 3 статьи текущей рубрики -->
@php
    $other_articles_in_current_rubriks = App\Rubrik::with(
                    ['articles' => function ($query) {
                        $query->where('on_main', '=', 0)->orderby('updated_at', 'desc')->limit(3);
                    }]
               )->find($rubrik->id);
@endphp

@foreach($other_articles_in_current_rubriks['articles'] as $other_article)

    <a class="other_articles_link" href="{{route('article', $other_article->name_en)}}">
        &#9632; {{ $other_article->name_ru }}
    </a>

@endforeach

{{--{{ $rubrik->id }}--}}

    {{--@foreach(\App\Rubrik::with('articles')->orderBy('order')->get() as $rubrik_list)--}}
        {{--<div class="rubrikator_item_ribrik">--}}
            {{--<a class="rubrikator_link" href="{{route('rubrika', $rubrik_list->name_en)}}"> {{$rubrik_list->name_ru}} </a>--}}
        {{--</div>--}}
    {{--@endforeach--}}
