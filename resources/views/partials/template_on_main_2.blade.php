
<div class="container">

    {{--<div class="title_block">--}}
        {{--<div class="bgr_title_block"></div> <div class="bgr_title_block bgr_title_block_2"></div>--}}
        {{--<h1>{{ $rubrik->name_ru }}</h1>--}}
    {{--</div>--}}
    <h1 class="title_block_rubrik icon_rubrik_1">{{ $rubrik->name_ru }}</h1>

    <div class="row">

        @foreach($rubrik['articles'] as $article)
            @if($article)

                <div class="col-md-3">
                    <div class="item_article">
                        <img class="item_article_img" src="{{ asset('images/'.$article->image) }}" />
                        <a class="item_article_title" href="{{route('article', $article->name_en)}}">{{ $article->name_ru }}</a>
                        <p class="item_article_meta"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                        @php
                            $norm = strip_tags($article->article); $words = explode(' ', $norm);
                            if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                        @endphp
                        <p class="item_article_content">{{ $norm }}</p>
                        <div class="tochki"></div>
                    </div>
                </div>

            @endif
        @endforeach


        <!-- BANNERS -->
            {{--@foreach($banners as $banner)--}}
                {{--@if($banner->position == $articles->name_en)--}}
                    {{--<div class="col-md-3">--}}
                        {{--<div class="item_block">--}}
                            {{--<a href="{{$banner->link}}" title="{{$banner->name}}" target="_blank">--}}
                                {{--<img src="/images/banners/{{$banner->image}}" alt="{{$banner->name}}">--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{--@endforeach--}}

    </div>

</div>