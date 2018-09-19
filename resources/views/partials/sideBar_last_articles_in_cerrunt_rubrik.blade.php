
<h3 class="h3_rubriks">Читайте также</h3>

@php
//$rubrik_id = $article['rubriks'][0]->id;
//$last_articles = \App\Article::with(['rubriks' => function ($query) {
//    $rubrik_id = 51 //$article['rubriks'][0]->id;
//    $query->where('rubrik_id', '=', $rubrik_id);
//    }
//])->orderBy('id', 'desc')->take(1)->get();

$last_articles = \App\Article::with('rubriks')->orderBy('id', 'desc')->take(5)->get();
@endphp
@foreach($last_articles as $last_article)
    @php //echo $article['rubriks'][0]->id;  //echo $article->name_ru; echo'<pre>';  var_dump($article->rubriks[0]->name_ru); echo'</pre>'; @endphp
    <div class="item_block_last_art">
        @php
                //var_dump($last_article);
                @endphp
        <a href="{{route('rubrika', $last_article->rubriks[0]->name_en)}}" class="title_rubrik">{{ $last_article->rubriks[0]->name_ru }}</a>
        <a href="{{route('article', $last_article->name_en)}}" class="title_article">{{ $last_article->name_ru }}</a>
        <p class="meta_block"><span class="fa fa-clock-o"></span>{{ date_format($last_article->updated_at, "d.m.Y H:i:s") }}</p>
        @php
            $norm = strip_tags($last_article->article); $words = explode(' ', $norm);
            if( sizeof($words) > 25 ) {	$words = array_slice($words, 0, 25); $norm = implode(' ', $words) . ''; }
        @endphp
        <p class="content_article">{{ $norm }}</p>
    </div>
@endforeach