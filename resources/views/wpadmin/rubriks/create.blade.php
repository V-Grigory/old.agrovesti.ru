@extends('wpadmin.layouts.wpadmin')

@section('content')

    <div class="container">

        @component('wpadmin.components.breadcrumb')
            @slot('title') Список категория @endslot
            @slot('parent') Главная @endslot
            @slot('active') Категории @endslot
        @endcomponent

        <hr />

      <form class="form-horizontal" action="{{route('wpadmin')}}" method="post">
          {{ csrf_field() }}

          {{-- Form include --}}
          @include('wpadmin.rubriks.partials.form')
      </form>

    </div>

@endsection