@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>Подписчики</h1> <hr style="margin: 10px 0;" />

    <div id="readers_vue">

        @php
        print_r($clients);
        @endphp

        <ul>
            <li v-for="item in items">
                {{--@{{ item.message }}--}}
                11
            </li>
            {{--@{{name}}--}}
        </ul>

    </div>

@endsection