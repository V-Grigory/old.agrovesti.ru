
<h3 class="h3_rubriks">РУБРИКИ</h3>
<div class="wrap_rubriks">
    @foreach(\App\Rubrik::with('articles')->orderBy('order')->get() as $rubrik_list)
        <div class="item_ribrik">
            <span class="fon_item_rubrik"></span>
            <a class="link_in_rubrik" href="{{route('rubrika', $rubrik_list->name_en)}}"> {{$rubrik_list->name_ru}} </a>
            <span class="count_art_in_rubrik">
                ({{$rubrik_list->articles()->count()}})
            </span>
        </div>
    @endforeach
</div>