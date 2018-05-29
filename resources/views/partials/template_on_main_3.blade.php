
<div class="container">

    <h1 class="title_block_rubrik icon_rubrik_1">{{ $rubrik->name_ru }}</h1>

    <div class="row">

        @foreach($rubrik['articles'] as $article)
            @if($article)

                <div class="col-md-3">
                    <div class="item_block">
                        Блок в разработке
                    </div>
                </div>

            @endif
        @endforeach

    </div>
</div>