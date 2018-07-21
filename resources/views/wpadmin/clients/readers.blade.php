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


                <!-- === Вывод подписчиков === -->
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
                            <form class="form_wpadmin_readers" action="{{route('wpadmin.clients.update', $client)}}" method="post" enctype="multipart/form-data" >
                                <input type="hidden" name="_method" value="PUT" />
                                <input type="hidden" name="id" value="{{$client->id}}" />
                                {{ csrf_field() }}

                                <td style="padding:5px;">
                                    {{ $client->phone }}
                                    <input type="text" class="form-control" name="name" value="{{$client->phone}}" />
                                </td>

                                <td>
                                    {{ $client->f_name }}
                                    <input type="text" class="form-control" name="name" value="{{$client->f_name}}" />
                                </td>

                                <td>
                                    {{ $client->i_name }}
                                    <input type="text" class="form-control" name="name" value="{{$client->i_name}}" />
                                </td>

                                <td>
                                    {{ $client->o_name }}
                                    <input type="text" class="form-control" name="name" value="{{$client->o_name}}" />
                                </td>

                                <td>
                                    {{ $client->email }}
                                    <input type="text" class="form-control" name="name" value="{{$client->email}}" />
                                </td>

                                <td>
                                    {{ $client->company }}
                                    <input type="text" class="form-control" name="name" value="{{$client->company}}" />
                                </td>

                                <td>
                                    {{ $client->status_pay }}
                                    <input type="text" class="form-control" name="name" value="{{$client->status_pay}}" />
                                </td>

                                <td>
                                    {{ $client->range_pay }}
                                    <input type="text" class="form-control" name="name" value="{{$client->range_pay}}" />
                                </td>

                                <td>
                                    {{ $client->status_activity }}
                                    <input type="text" class="form-control" name="name" value="{{$client->status_activity}}" />
                                </td>

                                <td class="text-right" style="padding: 0;">
                                    <button type="submit" class="btn btn-primary">Добавить баннер</button>
                                </td>

                            </form>
                        </tr>
                        <tr>
                            <td colspan="10">
                            <form class="form_wpadmin_readers form-inline" action="{{route('wpadmin.clients.update', $client)}}" method="post" enctype="multipart/form-data" >
                                <input type="hidden" name="_method" value="PUT" />
                                <input type="hidden" name="id" value="{{$client->id}}" />
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputEmail2">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword2">Пароль</label>
                                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
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