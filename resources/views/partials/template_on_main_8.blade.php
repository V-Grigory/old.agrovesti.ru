
<div class="container">

    <h1 class="title_block_rubrik icon_rubrik_{{ $rubrik->icon_number }}">
        <a class="title_block_rubrik_a" href="/rubrika/articles/{{ $rubrik->name_en }}">{{ $rubrik->name_ru }}</a>
    </h1>

    <div class="row">

        @foreach($rubrik['articles'] as $article)
            @if($article)

                <a href="{{route('article', $article->name_en)}}">
                    <img class="image_as_template" src="{{ asset('images/assets/preview_template_number_8.png') }}" />
                </a>

            @endif
        @endforeach

    </div>

</div>