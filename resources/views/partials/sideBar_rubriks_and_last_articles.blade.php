
<h3 class="h3_rubriks">РУБРИКИ</h3>
<div class="wrap_rubriks">
    @foreach(\App\Rubrik::with('articles')->get() as $rubrik_list)
        <div class="item_ribrik">
            <span class="fon_item_rubrik"></span>
            <a class="link_in_rubrik" href="{{route('rubrika', $rubrik_list->name_en)}}"> {{$rubrik_list->name_ru}} </a>
            <span class="count_art_in_rubrik">
                ({{$rubrik_list->articles()->count()}})
            </span>
        </div>
    @endforeach
</div>

<h3 class="h3_rubriks">СВЕЖИЕ СТАТЬИ</h3>
@php $last_articles = \App\Article::with('rubriks')->orderBy('id', 'desc')->take(5)->get(); @endphp
@foreach($last_articles as $last_article)
    @php //echo $article->name_ru; echo'<pre>';  var_dump($article->rubriks[0]->name_ru); echo'</pre>'; @endphp
    <div class="item_block_last_art">
        <a href="{{route('rubrika', $last_article->rubriks[0]->name_en)}}" class="title_rubrik">{{ $last_article->rubriks[0]->name_ru }}</a>
        <a href="{{route('article', $last_article->name_en)}}" class="title_article">{{ $last_article->name_ru }}</a>
        <p class="meta_block"><span class="fa fa-clock-o"></span>{{ $last_article->updated_at }}</p>
        @php
            $norm = strip_tags($last_article->article); $words = explode(' ', $norm);
            if( sizeof($words) > 25 ) {	$words = array_slice($words, 0, 25); $norm = implode(' ', $words) . ''; }
        @endphp
        <p class="content_article">{{ $norm }}</p>
    </div>
@endforeach