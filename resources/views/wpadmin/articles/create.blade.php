@extends('wpadmin.layouts.wpadmin')

@section('content')

    <div class="container">

        @component('wpadmin.components.breadcrumb')
            @slot('title') Список новости @endslot
            @slot('parent') Главная @endslot
            @slot('active') Новости @endslot
        @endcomponent

        <hr />

        <form class="form-horizontal" action="{{route('wpadmin')}}" method="post">
            {{ csrf_field() }}

            {{-- Form include --}}
            @include('wpadmin.articles.partials.form')

            <input type="hidden" name="created_by" value="{{Auth::id()}}" />
        </form>

    </div>

@endsection