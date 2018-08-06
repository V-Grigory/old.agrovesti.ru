
@php
    $other_articles_in_current_rubriks = App\Rubrik::with(
                    ['articles' => function ($query) {
                        $query->where('on_main', '=', 0)->orderby('updated_at', 'desc')->limit(4);
                    }]
               )->find($rubrik->id);
@endphp

@foreach($other_articles_in_current_rubriks['articles'] as $other_article)

    @if($loop->iteration == 4)
        <div class="col-md-3" style="margin: 15px 0;">
    @else
        <div class="col-md-3" style="margin: 15px 0;border-right: 3px solid #c0c0c0;">
    @endif

        <div class="col-md-6" style="padding: 0;">
            <img class="item_article_img" src="{{asset('images/'.$other_article->image)}}" />
        </div>
        <div class="col-md-6" style="padding: 7px 0 0 7px;font-size:13px;">
            <a class="other_articles_link" href="{{route('article', $other_article->name_en)}}">
                {{ limit_words($other_article->name_ru, 5) }}
            </a>
            <p class="item_article_meta" style="margin:0;"><span class="fa fa-clock-o"></span>{{ date_format($other_article->updated_at, 'd.m.Y') }}</p>
        </div>

    </div>

@endforeach