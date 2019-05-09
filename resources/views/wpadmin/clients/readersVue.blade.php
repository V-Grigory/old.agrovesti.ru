@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>Подписчики</h1> <hr style="margin: 10px 0;" />

    <div id="readers_vue">

        <table-clients>

            <client v-for="client in clients" :data_client="client"></client>

        </table-clients>

    </div>

@endsection