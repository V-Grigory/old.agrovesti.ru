@extends('wpadmin.layouts.wpadmin')

@section('content')

    <div class="container">

        @component('wpadmin.components.breadcrumb')
            @slot('title') Редактирование категории @endslot
            @slot('parent') Главная @endslot
            @slot('active') Категории @endslot
        @endcomponent

        <hr />

        <form class="form-horizontal" action="{{route('admin.rubrik.store', $rubrik)}}" method="post">
            <input type="hidden" name="_method" value="put" />
            {{ csrf_field() }}

            {{-- Form include --}}
            @include('wpadmin.rubriks.partials.form')
        </form>

    </div>

@endsection