@extends('layouts.app')

@section('content')
    <div class="container">

        @if($is_login)

            <h1 class="lk_h1">Профиль пользователя <a class="lk_a_logout" href="/lk/logout">Выйти</a></h1>



            <h2 class="lk_h2">Подписка</h2>

            {{--{{ $is_login }}--}}

        @else

            <h1 class="lk_h1">Авторизация</h1>
            @include('lk.login')

        @endif

    </div>
@endsection