@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>{{$page->name_ru}}</h1> <hr />

    {{--@if($error_validate)--}}
        {{--<div style="padding:10px;background-color:#ec7063;color:white;">--}}
            {{--{{$error_validate}}--}}
        {{--</div>--}}
    {{--@endif--}}
    {{--@if($article_saved)--}}
        {{--<div style="padding:10px;background-color:#17a589;color:white;">--}}
            {{--{{$article_saved}}--}}
        {{--</div>--}}
    {{--@endif--}}

    <form action="/wpadmin/{{$page->name_en}}" method="post" enctype="multipart/form-data" >
{{--    <form action="{{route('wpadmin.pages.store')}}" method="post" enctype="multipart/form-data" >--}}
        {{ csrf_field() }}

        <div class="form-group">
            <p style="margin:0 0 8px 0;color:#666666;"><b>Название статьи</b></p>
            <input type="text" class="form-control" name="name_ru" value="{{$page->name_ru or ""}}"  />
        </div>

        <div class="form-group">
            <textarea id="content_article" class="form-control" name="article">{{$page->content or ""}}</textarea>
        </div>

        <div class="form-group">
            <input type="hidden" name="id" value="{{$page->id or ""}}" />
            <button type="submit" class="btn btn-primary">СОХРАНИТЬ СТАТЬЮ</button>
        </div>

    </form>

@endsection