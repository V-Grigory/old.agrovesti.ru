<div class="container">

    @foreach($rubrik['articles'] as $article)
        @if($article)

                <div class="row wrap_template_9">

                    <img class="template_9_image" src="{{ asset('images/assets/preview_template_number_9.png') }}" />

                    <div class="wrap_template_9_content">
                        <div class="col-md-6">
                        </div>

                        <div class="col-md-6">

                            <a class="template_9_rubrika_title" href="/rubrika/articles/{{ $rubrik->name_en }}"> {{ $rubrik->name_ru }} </a>

                            <a class="template_9_article_title" href="{{route('article', $article->name_en)}}"> {{ $article->name_ru }} </a>
                            <p class="template_9_article_content">
                                {{ limit_words($article->article, 30) }}
                            </p>

                        </div>
                    </div>

                </div>

        @endif
    @endforeach

</div>