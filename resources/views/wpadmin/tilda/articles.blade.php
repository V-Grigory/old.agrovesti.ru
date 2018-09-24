@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>Статьи в Тильде</h1> <hr />

    @if( $msg != '' )
        <div style="padding: 10px; background-color: #d68080;color: #fff;">
            {{ $msg }}
        </div>
        <hr />
    @endif


    <p><b>Новых опубликованных статей в Тильде: {{$cnt_for_add}}</b></p>

    <p><b>Измененных и опубликованных статей в Тильде: {{$cnt_for_update}}</b></p>

    <ul>
        @foreach($published_articles as $published_article)

            <li>{{ $published_article }}</li>

        @endforeach
    </ul>

    <hr />

    @if($cnt_for_add > 0 || $cnt_for_update > 0)
        <a href="?start_sync" type="button" class="btn btn-primary">СИНХРОНИЗИРОВАТЬ</a>
    @endif

    {{-- обновление с указнием pageid --}}
    <hr />
    <p><b>Введите идентификатор статьи.<br />Например: page3635144.html - идентификатор: 3635144</b></p>
    <form action="{{route('wpadmin.tilda.articles')}}" method="get">
        {{--{{ csrf_field() }}--}}
        <div class="form-group">
            <input type="text" name="pageid" value="" />
            <button type="submit" name="start_sync_by_pageid" class="btn btn-primary">СТАРТ</button>
        </div>
    </form>

@endsection