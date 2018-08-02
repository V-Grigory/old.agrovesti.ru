@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>Статья</h1> <hr />

    {{--@if($rubrik)--}}
        {{--<form action="{{route('wpadmin.rubrik.update', $rubrik)}}" method="post" class="form-inline" >--}}
        {{--<input type="hidden" name="_method" value="PUT" />--}}
    {{--@else--}}
        {{--<form action="{{route('wpadmin.rubrik.store', $rubrik)}}" method="post" class="form-inline" >--}}
    {{--@endif--}}

    {{--@if(isset($article))--}}
        {{--{{var_dump($article)}}--}}
    {{--@endif--}}

        @if($error_validate)
            <div style="padding:10px;background-color:#ec7063;color:white;">
                {{$error_validate}}
            </div>
        @endif
        @if($article_saved)
            <div style="padding:10px;background-color:#17a589;color:white;">
                {{$article_saved}}
            </div>
        @endif

        <form action="{{route('wpadmin.article.store')}}" method="post" enctype="multipart/form-data" >
            {{ csrf_field() }}

            <div class="form-group">
                <p style="margin:0 0 8px 0;color:#666666;"><b>Название статьи</b></p>
                <input type="text" class="form-control" name="name_ru" value="{{$article->name_ru or ""}}"  />
                <input type="hidden" name="name_en" value="{{$article->name_en or ""}}" />
            </div>

            <div class="form-group">
                <p style="margin:0 0 8px 0;color:#666666;"><b>В каких рубриках</b></p>
                @foreach($rubriks as $rubrik_list)
                    <label class="checkbox-inline">
                        <input type="checkbox" name="rubrik_id[]" value="{{$rubrik_list->id}}"
                            @if(isset($article->rubrik_id) && in_array($rubrik_list->id, $article->rubrik_id)  ) checked @endif
                        > {{$rubrik_list->name_ru}}
                    </label>
                @endforeach
            </div>

            <div class="form-group">
                <p style="margin:0 0 8px 0;color:#666666;"><b>Главная картинка 620 х 620 пикс.</b></p>
                <input type="file" name="image" value=""/>
            </div>

            <div class="form-group">
                <p style="margin:0 0 8px 0;color:#666666;"><b>Опции</b></p>
                <label class="checkbox-inline">
                    <input type="checkbox" name="on_main" value="1" @if(isset($article->on_main)) checked @endif >
                    Разместить на главной
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="main_article" value="1" @if(isset($article->main_article)) checked @endif >
                    Главная статья рубрики
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="need_pay" value="1" @if(isset($article->need_pay)) checked @endif >
                    Платная статья
                </label>
                <br/>
                <label class="checkbox-inline">
                    <input type="checkbox" name="disable_comments" value="disable_comments"
                    @if(isset($article->features) && strpos($article->features,'disable_comments') !== false) checked @endif >
                    Запретить комментировать статью
                </label>
                <br/>
                <label class="checkbox-inline">
                    <input type="checkbox" name="in_footer_block_1" value="in_footer_block_1"
                    @if(isset($article->features) && strpos($article->features,'in_footer_block_1') !== false) checked @endif >
                    Выводить в подвале - Центральные темы
                </label>
                <br/>
                <label class="checkbox-inline">
                    <input type="checkbox" name="in_footer_block_2" value="in_footer_block_2"
                    @if(isset($article->features) && strpos($article->features,'in_footer_block_2') !== false) checked @endif >
                    Выводить в подвале - Реклама
                </label>
                <br/>
                <label class="checkbox-inline">
                    <input type="checkbox" name="in_footer_block_3" value="in_footer_block_3"
                    @if(isset($article->features) && strpos($article->features,'in_footer_block_3') !== false) checked @endif >
                    Выводить в подвале - Контакты
                </label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">СОХРАНИТЬ СТАТЬЮ</button>
            </div>

            <div class="form-group">
                <textarea id="content_article" class="form-control" name="article">{{$article->article or ""}}</textarea>
            </div>

            <input type="hidden" name="id" value="{{$article->id or ""}}" />

            <div class="form-group">
                <button type="submit" class="btn btn-primary">СОХРАНИТЬ СТАТЬЮ</button>
            </div>

    </form>

@endsection