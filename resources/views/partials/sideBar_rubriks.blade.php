
<h3 class="rubrikator_h3">ТЕМЫ</h3>
<div class="rubrikator_wrap">
    @foreach(\App\Rubrik::with('articles')->where('order', '>', 0)->orderBy('order', 'ASC')->get() as $rubrik_list)
        <div class="rubrikator_item_ribrik">
            {{--<span class="fon_item_rubrik"></span>--}}
            <a class="rubrikator_link" href="{{route('rubrika', $rubrik_list->name_en)}}"> {{$rubrik_list->name_ru}} </a>
            {{--<span class="count_art_in_rubrik">--}}
                {{--({{$rubrik_list->articles()->count()}})--}}
            {{--</span>--}}
        </div>
    @endforeach
</div>