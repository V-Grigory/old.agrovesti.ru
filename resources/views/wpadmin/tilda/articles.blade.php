@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>Статьи в Тильде</h1> <hr />

    <p><b>Новых опубликованных статей в Тильде: {{$cnt_for_add}}</b></p>

    <p><b>Измененных и опубликованных статей в Тильде: {{$cnt_for_update}}</b></p>

    <ul>
        @foreach($published_articles as $published_article)

            <li>{{ $published_article }}</li>

        @endforeach
    </ul>

@endsection