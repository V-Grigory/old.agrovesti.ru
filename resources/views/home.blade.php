@extends('layouts.app')

@include('partials.limit_words')

@section('content')

    @php
    $rubriks = App\Rubrik::with(
                    ['articles' => function ($query) {
                        $query->where('on_main', '=', 1)->orderBy('updated_at', 'desc');
                    }]
               )
               ->where('on_main', 1)
               ->where('target', 'old_site')
               ->where('template_number', '<', 10)
               ->orderBy('position_number', 'asc')->get();
    @endphp

    @if($rubriks)

        @foreach($rubriks as $rubrik)

            @include("partials.template_on_main_{$rubrik->template_number}")

        @endforeach

    @else
        <div style="text-align:center;margin: 50px 0;font-size: 20px;">Не указано ни одной рубрики для вывода.</div>
    @endif

@endsection
