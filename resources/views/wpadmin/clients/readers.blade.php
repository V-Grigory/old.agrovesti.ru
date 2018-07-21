@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>Подписчики</h1> <hr />

    @if(isset($params) && $params->err_store)
        <div style="padding:10px;background-color:#ec7063;color:white;">
            {{$params->err_store}}
        </div>
    @endif


    <form class="form_wpadmin_readers" action="{{route('wpadmin.clients.store', $client)}}" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="_method" value="PUT" />
        <input type="hidden" name="id" value="22" />
        {{ csrf_field() }}



            <input type="text" class="form-control" name="name" value="wqwq" />




            <button type="submit" class="btn btn-primary">Добавить баннер</button>


    </form>


    {{-- === Вывод подписчиков === --}}
    <table class="table table-striped">
        <thead>
            <th>Телефон</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Email</th>
            <th>Компания</th>
            <th>Оплата</th>
            <th>Период оплаты</th>
            <th>Статус</th>
            <th class="text-right">Действие</th>
        </thead>
        <tbody>
        @forelse($clients as $client)
            <tr>
                <td style="padding:5px;"> {{ $client->phone }} </td>
                <td> {{ $client->f_name }} </td>
                <td> {{ $client->i_name }} </td>
                <td> {{ $client->o_name }} </td>
                <td> {{ $client->email }} </td>
                <td> {{ $client->company }} </td>
                <td> {{ $client->status_pay }} </td>
                <td> {{ $client->range_pay }} </td>
                <td> {{ $client->status_activity }} </td>
                <td> <button type="submit" class="btn btn-primary">Добавить баннер</button> </td>
            </tr>
            {{-- строка для редактирования --}}
            <tr>
                <td colspan="10">
                    <form class="form-inline" action="{{route('wpadmin.clients.update', $client)}}" method="post" enctype="multipart/form-data" >
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="id" value="{{$client->id}}" />
                        {{ csrf_field() }}

                        <div class="col-md-1 readers_col-md">
                            <label>Телефон</label>
                            <input type="text" class="form-control" name="phone" value="{{$client->phone}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Фамилия</label>
                            <input type="text" class="form-control" name="f_name" value="{{$client->f_name}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Имя</label>
                            <input type="text" class="form-control" name="i_name" value="{{$client->i_name}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Отчество</label>
                            <input type="text" class="form-control" name="o_name" value="{{$client->o_name}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{$client->email}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Компания</label>
                            <input type="text" class="form-control" name="company" value="{{$client->company}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Оплата</label>
                            <input type="text" class="form-control" name="status_pay" value="{{$client->status_pay}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Период</label>
                            <input type="text" class="form-control" name="range_pay" value="{{$client->range_pay}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Статус</label>
                            <input type="text" class="form-control" name="status_activity" value="{{$client->status_activity}}" />
                        </div>
                        <div class="col-md-3 readers_col-md">
                            <button type="submit" class="btn btn-primary">Добавить баннер</button>
                        </div>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection