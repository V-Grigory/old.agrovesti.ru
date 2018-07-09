@extends('layouts.app')

@section('content')

    <h1>Профиль пользователя</h1>

    @if($is_login)
        {{ $is_login }}
    @else
        @include('lk.login')
    @endif

@endsection