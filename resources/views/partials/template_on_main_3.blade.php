
<div class="container">

    <h1 class="title_block_rubrik icon_rubrik_{{ $rubrik->icon_number }}">
        <a class="title_block_rubrik_a" href="/rubrika/articles/{{ $rubrik->name_en }}">{{ $rubrik->name_ru }}</a>
    </h1>

    <div class="row">

        {{-- слева статьи --}}
        <div class="col-md-9" style="padding:0;">

            @foreach($rubrik['articles'] as $article)
                @if($article)
                    {{-- статьи в широком формате --}}
                    <div class="col-md-12" style="padding:0;margin: 10px 0;">
                        <div class="col-md-6">
                            <img class="item_article_img item_article_img_wide" src="{{ asset('images/'.$article->image) }}" />
                        </div>
                        <div class="col-md-6">
                            <a class="item_article_title item_article_title_wide" href="{{route('article', $article->name_en)}}">
                                {{ $article->name_ru }}
                            </a>
                            <p class="item_article_meta"><span class="fa fa-clock-o"></span>{{ date_format($article->updated_at, "d.m.Y H:i:s") }}</p>
                            @php
                                $norm = strip_tags($article->article); $words = explode(' ', $norm);
                                if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                            @endphp
                            <p class="item_article_content item_article_content_wide">{{ $norm }}</p>
                            <div class="tochki"></div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>

        {{-- справа баннер и другие статьи --}}
        <div class="col-md-3">

            @php $banner = \App\Banner::where('position', $rubrik->name_en)->first(); @endphp
            @if($banner)
                <a href="{{$banner->link}}" title="{{$banner->name}}" target="_blank">
                    <img style="width: 265px;height: 590px;margin-bottom:15px;" src="/images/banners/{{$banner->image}}" alt="{{$banner->name}}">
                </a>
            @endif

            @include('partials.other_articles_with_image')

        </div>

    </div>
</div>