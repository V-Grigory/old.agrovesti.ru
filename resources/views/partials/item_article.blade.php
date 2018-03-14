
<div class="row">
    @php $articles = App\Rubrik::with(['articles' => function ($query) {
             $query->where('on_main', '=', 1);
         }])->find($rubrik_id);
    @endphp
    @foreach($articles['articles'] as $article)
            <div class="col-md-3">
                <div class="item_block">
                    <img src="{{ asset('images/'.$article->image) }}" />
                    <a href="{{route('article', $article->name_en)}}" class="title_article">{{ $article->name_ru }}</a>
                    <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>
                    @php
                        $norm = strip_tags($article->article); $words = explode(' ', $norm);
                        if( sizeof($words) > 30 ) {	$words = array_slice($words, 0, 30); $norm = implode(' ', $words) . ''; }
                    @endphp
                    <p class="content_article">{{ $norm }}</p>
                </div>
            </div>
    @endforeach

    <!-- BANNERS -->
    @foreach($banners as $banner)
        @if($banner->position == $articles->name_en)
            <div class="col-md-3">
                <div class="item_block">
                    <a href="{{$banner->link}}" title="{{$banner->name}}" target="_blank">
                        <img src="/images/banners/{{$banner->image}}" alt="{{$banner->name}}">
                    </a>
                </div>
            </div>
        @endif
    @endforeach

</div>
