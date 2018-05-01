@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="breadcrumb">
            <a href="/">ГЛАВНАЯ</a>
            <span>/</span>
            <span class="end_breadcrumb">{{ $page->name_ru }}</span>
        </div>

        <div class="row">

            <div class="col-md-9">
                <h1>{{ $page->name_ru }}</h1>
                {{--<div class="article_meta">--}}
                    {{--<p class="meta_block"><span class="fa fa-clock-o"></span>{{ $article->updated_at }}</p>--}}
                {{--</div>--}}

                <div class="article_wrap">@php echo($page->content); @endphp</div>
            </div>

            <div class="col-md-3">

                @include('partials.sideBar_rubriks')

            </div>

        </div>
    </div>

@endsection