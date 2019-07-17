
<h3 class="rubrikator_h3">ТЕМЫ</h3>
<div class="rubrikator_wrap">
    @foreach(\App\Rubrik::with('articles')
      ->where('order', '>', 0)
      ->where('target', 'old_site')
      ->orderBy('order', 'ASC')->get() as $rubrik_list
      )
        <div class="rubrikator_item_ribrik">
            <a
                class="rubrikator_link"
                href="{{route('rubrika', $rubrik_list->name_en)}}"
            >
              {{$rubrik_list->name_ru}} </a>
        </div>
    @endforeach
</div>